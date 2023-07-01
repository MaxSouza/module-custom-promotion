<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Command;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionSearchResultsInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionSearchResultsInterfaceFactory;
use MaxSouza\CustomPromotion\Model\ResourceModel\CustomPromotion\CollectionFactory;

class GetList implements GetListInterface
{
    /**
     * @param CollectionFactory $collectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CustomPromotionSearchResultsInterfaceFactory $customPromotionSearchResultsFactory
     */
    public function __construct(
        private readonly CollectionFactory $collectionFactory,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        private readonly CollectionProcessorInterface $collectionProcessor,
        private readonly CustomPromotionSearchResultsInterfaceFactory $customPromotionSearchResultsFactory
    ) {
    }

    /**
     * @inheritdoc
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null): CustomPromotionSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        $searchResult = $this->customPromotionSearchResultsFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
