<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Controller\Adminhtml\CustomPromotion;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'MaxSouza_CustomPromotion::view';

    /**
     * Execute method
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute(): ResultInterface|ResponseInterface
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('MaxSouza_CustomPromotion::management');
        $resultPage->addBreadcrumb(__('Custom Promotions'), __('Custom Promotions'));
        $resultPage->addBreadcrumb(__('Manage Custom Promotions'), __('Manage Custom Promotions'));
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Promotions'));

        return $resultPage;
    }
}
