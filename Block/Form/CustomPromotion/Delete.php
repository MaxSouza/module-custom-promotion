<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Block\Form\CustomPromotion;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;

class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->getCustomPromotionId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf(
                "deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this custom promotion?'),
                $this->getUrl(
                    '*/*/delete',
                    [CustomPromotionInterface::CUSTOM_PROMOTION_ID => $this->getCustomPromotionId()]
                )
            ),
            [],
            20
        );
    }
}
