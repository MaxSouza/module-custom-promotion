<?php declare(strict_types=1);

namespace MaxSouza\CustomPromotion\Ui\DataProvider;

use Magento\Backend\Model\Session;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Ui\DataProvider\SearchResultFactory;
use MaxSouza\CustomPromotion\Api\Data\CustomPromotionInterface;
use MaxSouza\CustomPromotion\Model\CustomPromotionRepository;

class CustomPromotionDataProvider extends DataProvider
{
    private const CUSTOM_PROMOTION_FORM_NAME = 'custom_promotion_form_data_source';

    /**
     * @var SearchResultFactory
     */
    private SearchResultFactory $searchResultFactory;

    /**
     * @var CustomPromotionRepository
     */
    private CustomPromotionRepository $cpRepository;

    /**
     * @var int
     */
    private int $customPromotionCount = 0;

    /**
     * @var Session
     */
    private Session $session;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $sCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param CustomPromotionRepository $cpRepository
     * @param SearchResultFactory $searchResultFactory
     * @param Session $session
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $sCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        CustomPromotionRepository $cpRepository,
        SearchResultFactory $searchResultFactory,
        Session $session,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $sCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
        $this->searchResultFactory = $searchResultFactory;
        $this->cpRepository = $cpRepository;
        $this->session = $session;
    }

    /**
     * Get search result
     *
     * @return SearchResultInterface
     */
    public function getSearchResult(): SearchResultInterface
    {
        $searchCriteria = $this->getSearchCriteria();
        $result = $this->cpRepository->getList($searchCriteria);

        return $this->searchResultFactory->create(
            $result->getItems(),
            $result->getTotalCount(),
            $searchCriteria,
            CustomPromotionInterface::CUSTOM_PROMOTION_ID
        );
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData(): array
    {
        $data = parent::getData();

        if (self::CUSTOM_PROMOTION_FORM_NAME === $this->name) {
            if ($data['totalRecords'] > 0) {
                $customPromotionId = $data['items'][0][CustomPromotionInterface::CUSTOM_PROMOTION_ID];
                $sourceGeneralData = $data['items'][0];
                $dataForSingle[$customPromotionId] = [
                    'general' => $sourceGeneralData,
                ];

                return $dataForSingle;
            }
            $sessionData = $this->session->getSourceFormData(true);
            if (null !== $sessionData) {
                $data = [
                    '' => $sessionData,
                ];
            }
        }

        $data['totalRecords'] = $this->getCustomPromotionCount();
        return $data;
    }

    /**
     * Get custom promotion count
     *
     * @return int
     */
    private function getCustomPromotionCount(): int
    {
        if (!$this->customPromotionCount) {
            $this->customPromotionCount = $this->cpRepository->getList()->getTotalCount();
        }

        return $this->customPromotionCount;
    }
}
