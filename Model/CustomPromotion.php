<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Model\ResourceModel\CustomPromotion as CustomPromotionResourceModel;

class CustomPromotion extends AbstractExtensibleModel implements CustomPromotionInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'custom_promotion_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CustomPromotionResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getCustomPromotionId(): ?int
    {
        return $this->getData(self::CUSTOM_PROMOTION_ID) === null ?
            null:
            (int)$this->getData(self::CUSTOM_PROMOTION_ID);
    }

    /**
     * @inheritdoc
     */
    public function setCustomPromotionId(?int $customPromotionId): void
    {
        $this->setData(self::CUSTOM_PROMOTION_ID, $customPromotionId);
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName(?string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(?string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getDiscountPercent(): ?float
    {
        return $this->getData(self::DISCOUNT_PERCENT) === null ? null
            : (float)$this->getData(self::DISCOUNT_PERCENT);
    }

    /**
     * @inheritDoc
     */
    public function setDiscountPercent(?float $discountPercent): void
    {
        $this->setData(self::DISCOUNT_PERCENT, $discountPercent);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryId(): ?int
    {
        return $this->getData(self::CATEGORY_ID) === null ? null
            : (int)$this->getData(self::CATEGORY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryId(?int $categoryId): void
    {
        $this->setData(self::CATEGORY_ID, $categoryId);
    }
}
