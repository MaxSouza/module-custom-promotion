<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Command;

use Exception;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterfaceFactory;
use MaxSouza\CustomPromotion\Exception\CustomPromotionCouldNotDeleteException;
use MaxSouza\CustomPromotion\Exception\CustomPromotionNoSuchEntityException;
use MaxSouza\CustomPromotion\Model\CustomPromotion;
use MaxSouza\CustomPromotion\Model\ResourceModel\CustomPromotion as CustomPromotionResourceModel;
use Psr\Log\LoggerInterface;

class DeleteById implements DeleteByIdInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var CustomPromotionInterfaceFactory
     */
    private CustomPromotionInterfaceFactory $modelFactory;

    /**
     * @var CustomPromotionResourceModel
     */
    private CustomPromotionResourceModel $resource;

    /**
     * @param LoggerInterface $logger
     * @param CustomPromotionInterfaceFactory $modelFactory
     * @param CustomPromotionResourceModel $resource
     */
    public function __construct(
        LoggerInterface             $logger,
        CustomPromotionInterfaceFactory $modelFactory,
        CustomPromotionResourceModel $resource
    ) {
        $this->logger = $logger;
        $this->modelFactory = $modelFactory;
        $this->resource = $resource;
    }

    /**
     * @inheritDoc
     */
    public function execute(int $customPromotionId): void
    {
        try {
            /** @var CustomPromotion $model */
            $model = $this->modelFactory->create();
            $this->resource->load($model, $customPromotionId, CustomPromotionInterface::CUSTOM_PROMOTION_ID);

            if (!$model->getData(CustomPromotionInterface::CUSTOM_PROMOTION_ID)) {
                throw new CustomPromotionNoSuchEntityException(
                    __(
                        'Could not find CustomPromotion with id: `%id`',
                        [
                            'id' => $customPromotionId
                        ]
                    )
                );
            }

            $this->resource->delete($model);
        } catch (Exception $exception) {
            $this->logger->error(
                __('Could not delete custom promotion. Original message: {message}'),
                [
                    'message' => $exception->getMessage(),
                    'exception' => $exception
                ]
            );
            throw new CustomPromotionCouldNotDeleteException(__('Could not delete custom promotion.'));
        }
    }
}
