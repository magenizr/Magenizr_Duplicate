<?php
declare(strict_types=1);

/**
 * Magenizr Duplicate
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\Duplicate\Helper;

use \Magento\Framework\App\Request\Http;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Data constructor.
     * @param Http $request
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        Http $request,
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->request = $request;

        parent::__construct($context);
    }

    /**
     * Check if feature is enabled
     *
     * @return mixed
     */
    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(
            'cms/magenizr_duplicate/enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
