<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\ResourceModel\CustomPromotion;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use MaxSouza\CustomPromotion\Model\CustomPromotion;
use MaxSouza\CustomPromotion\Model\ResourceModel\CustomPromotion as CustomPromotionResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_promotion_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(CustomPromotion::class, CustomPromotionResourceModel::class);
    }
}
