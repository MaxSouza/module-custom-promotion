<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use MaxSouza\CustomPromotion\Api\CustomPromotionRepositoryInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionSearchResultsInterface;
use MaxSouza\CustomPromotion\Model\CustomPromotion\Command\DeleteByIdInterface;
use MaxSouza\CustomPromotion\Model\CustomPromotion\Command\GetInterface;
use MaxSouza\CustomPromotion\Model\CustomPromotion\Command\GetListInterface;
use MaxSouza\CustomPromotion\Model\CustomPromotion\Command\SaveInterface;

class CustomPromotionRepository implements CustomPromotionRepositoryInterface
{
    /**
     * @param GetInterface $getCommand
     * @param SaveInterface $saveCommand
     * @param DeleteByIdInterface $deleteByIdCommand
     * @param GetListInterface $getListCommand
     */
    public function __construct(
        private readonly GetInterface $getCommand,
        private readonly SaveInterface $saveCommand,
        private readonly DeleteByIdInterface $deleteByIdCommand,
        private readonly GetListInterface $getListCommand
    ) {
    }

    /**
     * @inheritDoc
     */
    public function save(CustomPromotionInterface $customPromotion): int
    {
        return $this->saveCommand->execute($customPromotion);
    }

    /**
     * @inheritDoc
     */
    public function get(int $customPromotionId): CustomPromotionInterface
    {
        return $this->getCommand->execute($customPromotionId);
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): CustomPromotionSearchResultsInterface
    {
        return $this->getListCommand->execute($searchCriteria);
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $customPromotionId): void
    {
        $this->deleteByIdCommand->execute($customPromotionId);
    }
}
