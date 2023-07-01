<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Controller\Adminhtml\CustomPromotion;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use MaxSouza\CustomPromotion\Api\CustomPromotionRepositoryInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterfaceFactory;
use MaxSouza\CustomPromotion\Exception\CustomPromotionCouldNotSaveException;
use MaxSouza\CustomPromotion\Exception\CustomPromotionNoSuchEntityException;
use MaxSouza\CustomPromotion\Exception\CustomPromotionValidationException;

class Save extends Action implements HttpPostActionInterface
{
    public const ADMIN_RESOURCE = 'MaxSouza_CustomPromotion::save';

    /**
     * @param Context $context
     * @param CustomPromotionRepositoryInterface $cpRepository
     * @param CustomPromotionInterfaceFactory $entityDataFactory
     */
    public function __construct(
        private readonly Context $context,
        private readonly CustomPromotionRepositoryInterface $cpRepository,
        private readonly CustomPromotionInterfaceFactory $entityDataFactory
    ) {
        parent::__construct($this->context);
    }

    /**
     * Save Custom Promotion Action.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute(): ResponseInterface|ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        $requestData = $request->getPost()->toArray();

        if (empty($requestData['general']) || !$request->isPost()) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            $this->processRedirectAfterFailureSave($resultRedirect);
            return $resultRedirect;
        }

        $customPromotionId = (int)$request->getParam(CustomPromotionInterface::CUSTOM_PROMOTION_ID);
        try {
            $customPromotion = $this->cpRepository->get($customPromotionId);
        } catch (CustomPromotionNoSuchEntityException) {
            $customPromotion = $this->entityDataFactory->create();
        }

        if (empty($requestData['general']['id_field_name']) && !$customPromotion->isObjectNew()) {
            $this->messageManager->addErrorMessage(__('Could not save custom promotion.'));
            $this->dataPersistor->set('entity', $requestData);
            $this->processRedirectAfterFailureSave($resultRedirect, $customPromotion, $requestData);
            return $resultRedirect;
        }

        try {
            $customPromotion->addData($requestData['general']);
            $this->cpRepository->save($customPromotion);
            $this->messageManager->addSuccessMessage(
                __('The Custom Promotion data was saved successfully')
            );
            return $resultRedirect->setPath('*/*/');
        } catch (CustomPromotionValidationException $exception) {
            foreach ($exception->getErrors() as $localizedError) {
                $this->messageManager->addErrorMessage($localizedError->getMessage());
            }
            $this->_session->setSourceFormData($requestData);
            $this->processRedirectAfterFailureSave($resultRedirect, $customPromotion, $requestData);
        } catch (CustomPromotionCouldNotSaveException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            $this->_session->setSourceFormData($requestData);
            $this->processRedirectAfterFailureSave($resultRedirect, $customPromotion);
        } catch (Exception) {
            $this->messageManager->addErrorMessage(__('Could not save custom promotion'));
            $this->_session->setSourceFormData($requestData);
            $this->processRedirectAfterFailureSave($resultRedirect, $customPromotion);
        }

        return $resultRedirect;
    }

    /**
     * Get redirect url after unsuccessful custom promotion save.
     *
     * @param Redirect $resultRedirect
     * @param null|CustomPromotionInterface $customPromotion
     * @param array $requestData
     * @return void
     */
    private function processRedirectAfterFailureSave(
        Redirect $resultRedirect,
        ?CustomPromotionInterface $customPromotion = null,
        array $requestData = []
    ): void {

        if (!$customPromotion
            || $customPromotion->isObjectNew()
            || (!$customPromotion->isObjectNew() && !isset($requestData['general']['id_field_name']))
        ) {
            $resultRedirect->setPath('*/*/new');
        } else {
            $resultRedirect->setPath(
                '*/*/edit',
                [
                    CustomPromotionInterface::CUSTOM_PROMOTION_ID => $customPromotion->getCustomPromotionId(),
                    '_current' => true,
                ]
            );
        }
    }
}
