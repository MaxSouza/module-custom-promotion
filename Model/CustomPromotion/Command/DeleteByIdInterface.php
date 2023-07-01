<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Model\CustomPromotion\Command;

use MaxSouza\CustomPromotion\Exception\CustomPromotionCouldNotDeleteException;

interface DeleteByIdInterface
{

    /**
     * Delete CustomPromotion.
     *
     * @param int $customPromotionId
     *
     * @return void
     * @throws CustomPromotionCouldNotDeleteException
     */
    public function execute(int $customPromotionId): void;
}
