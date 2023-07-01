<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Command;

use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Exception\CustomPromotionNoSuchEntityException;

interface GetInterface
{

    /**
     * Get custom promotion data by given entityId
     *
     * @param int $customPromotionId
     * @return CustomPromotionInterface
     * @throws CustomPromotionNoSuchEntityException
     */
    public function execute(int $customPromotionId): CustomPromotionInterface;
}
