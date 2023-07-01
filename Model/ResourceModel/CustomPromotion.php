<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;

class CustomPromotion extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_promotion_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('custom_promotion', CustomPromotionInterface::CUSTOM_PROMOTION_ID);
        $this->_useIsObjectNew = true;
    }
}
