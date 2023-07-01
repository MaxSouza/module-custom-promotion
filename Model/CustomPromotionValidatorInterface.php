<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model;

use Magento\Framework\Validation\ValidationResult;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;

/**
 * @api
 */
interface CustomPromotionValidatorInterface
{
    /**
     * Validate method
     *
     * @param CustomPromotionInterface $customPromotion
     * @return ValidationResult
     */
    public function validate(CustomPromotionInterface $customPromotion): ValidationResult;
}
