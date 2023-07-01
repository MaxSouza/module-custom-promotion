<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionSearchResultsInterface;
use MaxSouza\CustomPromotion\Exception\CustomPromotionCouldNotDeleteException;
use MaxSouza\CustomPromotion\Exception\CustomPromotionCouldNotSaveException;
use MaxSouza\CustomPromotion\Exception\CustomPromotionNoSuchEntityException;
use MaxSouza\CustomPromotion\Exception\CustomPromotionValidationException;

/**
 * @api
 */
interface CustomPromotionRepositoryInterface
{
    /**
     * Save custom promotion
     *
     * @param CustomPromotionInterface $customPromotion
     * @return int
     * @throws CustomPromotionValidationException
     * @throws CustomPromotionCouldNotSaveException
     */
    public function save(CustomPromotionInterface $customPromotion): int;

    /**
     * Get custom promotion
     *
     * @param int $customPromotionId
     * @return CustomPromotionInterface
     * @throws CustomPromotionNoSuchEntityException
     */
    public function get(int $customPromotionId): CustomPromotionInterface;

    /**
     * Get list of custom promotions
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return CustomPromotionSearchResultsInterface
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria = null
    ): CustomPromotionSearchResultsInterface;

    /**
     * Delete custom promotion by id
     *
     * @param int $customPromotionId
     * @return void
     * @throws CustomPromotionNoSuchEntityException
     * @throws CustomPromotionCouldNotDeleteException
     */
    public function deleteById(int $customPromotionId): void;
}
