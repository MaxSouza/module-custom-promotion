<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Command;

use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterfaceFactory;
use MaxSouza\CustomPromotion\Exception\CustomPromotionNoSuchEntityException;
use MaxSouza\CustomPromotion\Model\ResourceModel\CustomPromotion as CustomPromotionResourceModel;

class Get implements GetInterface
{
    /**
     * @param CustomPromotionResourceModel $cpResource
     * @param CustomPromotionInterfaceFactory $cpFactory
     */
    public function __construct(
        private readonly CustomPromotionResourceModel $cpResource,
        private readonly CustomPromotionInterfaceFactory $cpFactory
    ) {
    }

    /**
     * @inheritdoc
     */
    public function execute(int $customPromotionId): CustomPromotionInterface
    {
        $customPromotion = $this->cpFactory->create();
        $this->cpResource->load(
            $customPromotion,
            $customPromotionId,
            CustomPromotionInterface::CUSTOM_PROMOTION_ID
        );

        if (null === $customPromotion->getCustomPromotionId()) {
            throw new CustomPromotionNoSuchEntityException(
                __(
                    'Custom promotion with id "%value" does not exist.',
                    ['value' => $customPromotionId]
                )
            );
        }

        return $customPromotion;
    }
}
