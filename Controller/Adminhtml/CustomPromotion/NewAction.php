<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Controller\Adminhtml\CustomPromotion;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class NewAction extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'MaxSouza_CustomPromotion::management';

    /**
     * Execute method
     *
     * @return Page|ResultInterface
     */
    public function execute(): Page|ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('MaxSouza_CustomPromotion::management');
        $resultPage->getConfig()->getTitle()->prepend(__('New Custom Promotion'));

        return $resultPage;
    }
}
