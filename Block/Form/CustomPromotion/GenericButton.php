<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Block\Form\CustomPromotion;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;

class GenericButton
{
    /**
     * @var Context
     */
    private Context $context;
    /**
     * @var UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * Get custom promotion id
     *
     * @return int
     */
    public function getCustomPromotionId(): int
    {
        return (int)$this->context->getRequest()->getParam(CustomPromotionInterface::CUSTOM_PROMOTION_ID);
    }

    /**
     * Wrap button settings
     *
     * @param string $label
     * @param string $class
     * @param string $onclick
     * @param array $dataAttribute
     * @param int $sortOrder
     *
     * @return array
     */
    protected function wrapButtonSettings(
        string $label,
        string $class,
        string $onclick = '',
        array $dataAttribute = [],
        int $sortOrder = 0
    ): array {
        return [
            'label' => $label,
            'on_click' => $onclick,
            'data_attribute' => $dataAttribute,
            'class' => $class,
            'sort_order' => $sortOrder
        ];
    }

    /**
     * Get Url
     *
     * @param string $route
     * @param array $params
     *
     * @return string
     */
    protected function getUrl(string $route, array $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
