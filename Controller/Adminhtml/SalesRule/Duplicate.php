<?php
declare(strict_types=1);

/**
 * Magenizr Duplicate
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\Duplicate\Controller\Adminhtml\Salesrule;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\SalesRule\Model\Rule;

class Duplicate extends \Magento\Backend\App\Action
{
    /**
     * @var Rule
     */
    protected $rule;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Init constructor
     *
     * @param Context $context
     * @param Rule $rule
     * @param RequestInterface $request
     */
    public function __construct(
        Context $context,
        Rule $rule,
        RequestInterface $request
    ) {
        parent::__construct($context);
        $this->rule = $rule;
        $this->request = $request;
    }

    /**
     * Execute controller
     *
     * @return void
     */
    public function execute()
    {
        $id = $this->request->getParam('id');

        try {

            $rule = $this->rule->load($id);

            $clone = clone $rule;
            $clone->setName(sprintf('%s (copy)', $rule->getName()));
            $clone->setRuleId(0);
            $clone->setIsActive(0);

            if ($clone->save()) {
                $this->messageManager->addSuccessMessage(
                    __('The cart price rule (%1) has been duplicated.', $rule->getName())
                );
            }

        } catch (\Exception $e) {

            $this->messageManager->addErrorMessage(
                __('Something went wrong while saving the rule data. Please review the error log.')
            );
        }

        $this->_redirect('sales_rule/promo_quote/');
    }
}
