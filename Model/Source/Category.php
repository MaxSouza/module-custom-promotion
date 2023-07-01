<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\Source;

use Magento\Catalog\Api\CategoryListInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;

class Category implements OptionSourceInterface
{
    private const CATEGORY_ID_FIELD = 'entity_id';

    private const ROOT_CATEGORY_ID = 1;

    private const NOT_EQUAL_CONDITION = 'neq';

    /**
     * @param CategoryListInterface $categoryList
     * @param SearchCriteriaBuilder $sCriteriaBuilder
     */
    public function __construct(
        private readonly CategoryListInterface $categoryList,
        private readonly SearchCriteriaBuilder $sCriteriaBuilder
    ) {
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        $defaultOption = ['value' => '', 'label' => __('-- Please Select --')];
        $categoryList = array_map(static function ($category) {
            return [
                'value' => $category->getId(),
                'label' => $category->getName()
            ];
        }, $this->getCategoryList());

        array_unshift($categoryList, $defaultOption);

        return $categoryList;
    }

    /**
     * Get category list
     *
     * @return array
     */
    private function getCategoryList(): array
    {
        $searchCriteria = $this->sCriteriaBuilder
            ->addFilter(
                self::CATEGORY_ID_FIELD,
                self::ROOT_CATEGORY_ID,
                self::NOT_EQUAL_CONDITION
            )
            ->create();

        $categoryList = $this->categoryList->getList($searchCriteria);

        if ($categoryList->getTotalCount() === 0) {
            return [];
        }

        return $categoryList->getItems();
    }
}
