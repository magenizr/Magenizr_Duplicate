<?php
declare(strict_types=1);

/**
 * Magenizr Duplicate
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\Duplicate\Block\Adminhtml\SalesRule;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magenizr\Duplicate\Helper\Data as DataHelper;

class DuplicateButton implements ButtonProviderInterface
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * @param DataHelper $dataHelper
     * @param UrlInterface $urlBuilder
     * @param RequestInterface $request
     */
    public function __construct(
        DataHelper $dataHelper,
        UrlInterface $urlBuilder,
        RequestInterface $request
    ) {
        $this->dataHelper = $dataHelper;
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
    }

    /**
     * Add duplicate button
     *
     * @return array|void
     */
    public function getButtonData()
    {
        $id = $this->request->getParam('id');

        $isEnabled = $this->dataHelper->isEnabled();

        if ($isEnabled && !empty($id)) {

            return [
                'label' => __('Duplicate'),
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to duplicate this Cart Price rule?'
                ) . '\', \'' . $this->urlBuilder->getUrl(
                    'magenizr_duplicate/salesRule/duplicate',
                    ['id' => $id]
                ) . '\', {data: {}})',
                'sort_order' => 90
            ];
        }
    }
}
