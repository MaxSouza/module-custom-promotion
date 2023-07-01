<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;

class CustomPromotionChain implements CustomPromotionValidatorInterface
{
    /**
     * @var array
     */
    private array $validators;

    /**
     * @param ValidationResultFactory $valResultFactory
     * @param array $validators
     * @throws LocalizedException
     */
    public function __construct(
        private readonly ValidationResultFactory $valResultFactory,
        array $validators = []
    ) {
        foreach ($validators as $validator) {
            if (!$validator instanceof CustomPromotionValidatorInterface) {
                throw new LocalizedException(
                    __('Custom Promotion Validator must implement CustomPromotionValidatorInterface.')
                );
            }
        }
        $this->validators = $validators;
    }

    /**
     * @inheritdoc
     */
    public function validate(CustomPromotionInterface $customPromotion): ValidationResult
    {
        $errors = [[]];
        foreach ($this->validators as $validator) {
            $validationResult = $validator->validate($customPromotion);

            if (!$validationResult->isValid()) {
                $errors[] = $validationResult->getErrors();
            }
        }

        $errors = array_merge(...$errors);

        return $this->valResultFactory->create(['errors' => $errors]);
    }
}
