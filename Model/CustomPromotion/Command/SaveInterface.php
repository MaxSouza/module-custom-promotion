<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Command;

use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Exception\CustomPromotionCouldNotSaveException;
use MaxSouza\CustomPromotion\Exception\CustomPromotionValidationException;

/**
 * @api
 */
interface SaveInterface
{
    /**
     * Save Custom Promotion.
     *
     * @param CustomPromotionInterface $customPromotion
     *
     * @return int
     * @throws CustomPromotionCouldNotSaveException
     * @throws CustomPromotionValidationException
     */
    public function execute(CustomPromotionInterface $customPromotion): int;
}
