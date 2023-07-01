<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Validator;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Model\CustomPromotionValidatorInterface;

class CategoryValidator implements CustomPromotionValidatorInterface
{
    /**
     * Category validator's construct
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
        $value = (int)$customPromotion->getCategoryId();
        $errors = [];

        if (0 === $value) {
            // we can add many validators creating specific classes.
            $errors[] = __('"%field" can not be empty.', ['field' => 'category']);
        }

        return $this->valResultFactory->create(['errors' => $errors]);
    }
}
