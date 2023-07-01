<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Api\Data;

interface CustomPromotionInterface
{
    public const CUSTOM_PROMOTION_ID = 'custom_promotion_id';
    public const ENTITY_ID = "entity_id";
    public const NAME = "name";
    public const DESCRIPTION = "description";
    public const DISCOUNT_PERCENT = "discount_percent";
    public const CATEGORY_ID = "category_id";

    /**
     * Get custom promotion id
     *
     * @return int|null
     */
    public function getCustomPromotionId(): ?int;

    /**
     * Set custom promotion id
     *
     * @param int|null $customPromotionId
     *
     * @return void
     */
    public function setCustomPromotionId(?int $customPromotionId): void;

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * Set name
     *
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void;

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Set description
     *
     * @param string|null $description
     *
     * @return void
     */
    public function setDescription(?string $description): void;

    /**
     * Get discount percent
     *
     * @return float|null
     */
    public function getDiscountPercent(): ?float;

    /**
     * Set discount percent
     *
     * @param float|null $discountPercent
     *
     * @return void
     */
    public function setDiscountPercent(?float $discountPercent): void;

    /**
     * Get category id
     *
     * @return int|null
     */
    public function getCategoryId(): ?int;

    /**
     * Set category id
     *
     * @param int|null $categoryId
     *
     * @return void
     */
    public function setCategoryId(?int $categoryId): void;
}
