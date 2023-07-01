<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model;

use Magento\Framework\Api\SearchResults;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionSearchResultsInterface;

class CustomPromotionSearchResults extends SearchResults implements CustomPromotionSearchResultsInterface
{
}
