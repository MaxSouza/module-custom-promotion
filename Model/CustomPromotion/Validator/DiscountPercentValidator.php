<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Validator;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Model\CustomPromotionValidatorInterface;

class DiscountPercentValidator implements CustomPromotionValidatorInterface
{

    /**
     * DiscountPercent validator's construct
     *
     * @param ValidationResultFactory $valResultFactory
     */
    public function __construct(
        private readonly ValidationResultFactory $valResultFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function validate(CustomPromotionInterface $customPromotion): ValidationResult
    {
        $value = $customPromotion->getDiscountPercent();
        $errors = [];

        if (!is_numeric($value)) {
            $errors[] = __('"%field" should be numeric.', ['field' => CustomPromotionInterface::DISCOUNT_PERCENT]);
        }

        if (!$value) {
            $errors[] = __('"%field" can not be empty.', ['field' => CustomPromotionInterface::DISCOUNT_PERCENT]);
        }

        if ($value < 0) {
            $errors[] = __('"%field" can not be negative.', ['field' => CustomPromotionInterface::DISCOUNT_PERCENT]);
        }

        return $this->valResultFactory->create(['errors' => $errors]);
    }
}
