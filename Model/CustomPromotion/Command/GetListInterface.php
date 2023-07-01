<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Command;

use Magento\Framework\Api\SearchCriteriaInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionSearchResultsInterface;

/**
 * @api
 */
interface GetListInterface
{

    /**
     * Execute method
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return CustomPromotionSearchResultsInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null): CustomPromotionSearchResultsInterface;
}
