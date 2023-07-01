<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Validator;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Model\CustomPromotionValidatorInterface;

class NameValidator implements CustomPromotionValidatorInterface
{
    /**
     * Name validator's construct
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
        $value = (string)$customPromotion->getName();

        $errors = [];

        if ('' === trim($value)) {
            // we can add many validators creating specific classes.
            $errors[] = __('"%field" can not be empty.', ['field' => CustomPromotionInterface::NAME]);
        }

        return $this->valResultFactory->create(['errors' => $errors]);
    }
}
