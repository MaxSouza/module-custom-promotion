<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface CustomPromotionSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get custom promotion items list
     *
     * @return CustomPromotionInterface[]
     */
    public function getItems();

    /**
     * Set custom promotion items list
     *
     * @param CustomPromotionInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
