<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Controller\Adminhtml\CustomPromotion;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use MaxSouza\CustomPromotion\Api\CustomPromotionRepositoryInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;

class Delete extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'MaxSouza_CustomPromotion::delete';

    /**
     * @param Context $context
     * @param CustomPromotionRepositoryInterface $customPromotionRepository
     */
    public function __construct(
        private readonly Context $context,
        private readonly CustomPromotionRepositoryInterface $customPromotionRepository
    ) {
        parent::__construct($this->context);
    }

    /**
     * Delete Custom Promotion action.
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        /** @var ResultInterface $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        $customPromotionId = (int)$this->getRequest()->getParam(CustomPromotionInterface::CUSTOM_PROMOTION_ID);

        try {
            $this->customPromotionRepository->deleteById($customPromotionId);
            $this->messageManager->addSuccessMessage(__('You have successfully deleted Custom Promotion'));
        } catch (CouldNotDeleteException|NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        return $resultRedirect;
    }
}
