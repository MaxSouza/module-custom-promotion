<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Controller\Adminhtml\CustomPromotion;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use MaxSouza\CustomPromotion\Api\CustomPromotionRepositoryInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Exception\CustomPromotionNoSuchEntityException;

class Edit extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'MaxSouza_CustomPromotion::edit';

    /**
     * @param Context $context
     * @param CustomPromotionRepositoryInterface $cpRepository
     */
    public function __construct(
        private readonly Context $context,
        private readonly CustomPromotionRepositoryInterface $cpRepository
    ) {
        parent::__construct($this->context);
    }

    /**
     * Execute method
     *
     * @return Page|ResultInterface
     */
    public function execute(): Page|ResultInterface
    {
        try {
            $customPromotionId = (int)$this->getRequest()->getParam(CustomPromotionInterface::CUSTOM_PROMOTION_ID);
            $customPromotion = $this->cpRepository->get($customPromotionId);

            /** @var Page $resultPage */
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $resultPage->setActiveMenu('MaxSouza_CustomPromotion::management');
            $resultPage->getConfig()->getTitle()->prepend($customPromotion->getName());

            return $resultPage;
        } catch (CustomPromotionNoSuchEntityException $exception) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage($exception->getMessage());
            return $resultRedirect->setPath('*/*/');
        }
    }
}
