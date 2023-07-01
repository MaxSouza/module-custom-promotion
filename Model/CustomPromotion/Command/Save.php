<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Command;

use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Validation\ValidationException;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Exception\CustomPromotionCouldNotSaveException;
use MaxSouza\CustomPromotion\Exception\CustomPromotionValidationException;
use MaxSouza\CustomPromotion\Model\CustomPromotionValidatorInterface;
use MaxSouza\CustomPromotion\Model\ResourceModel\CustomPromotion as CustomPromotionResourceModel;
use Psr\Log\LoggerInterface;

class Save implements SaveInterface
{
    /**
     * @param LoggerInterface $logger
     * @param CustomPromotionResourceModel $resource
     * @param CustomPromotionValidatorInterface $cpValidator
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly CustomPromotionResourceModel $resource,
        private readonly CustomPromotionValidatorInterface $cpValidator
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(CustomPromotionInterface $customPromotion): int
    {
        $validationResult = $this->cpValidator->validate($customPromotion);
        if (!$validationResult->isValid()) {
            throw new CustomPromotionValidationException(__('Validation Failed'), null, 0, $validationResult);
        }

        try {
            $this->resource->save($customPromotion);
            return (int)$customPromotion->getCustomPromotionId();
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not save custom promotion. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CustomPromotionCouldNotSaveException(__('Could not save custom promotion.'));
        }
    }
}
