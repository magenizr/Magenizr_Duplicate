<?php
declare(strict_types=1);

/**
 * Magenizr Duplicate
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\Duplicate\Controller\Adminhtml\CatalogRule;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\CatalogRule\Api\CatalogRuleRepositoryInterface;

class Duplicate extends \Magento\Backend\App\Action
{
    /**
     * @var CatalogRuleRepositoryInterface
     */
    protected $ruleRepository;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Init constructor
     *
     * @param Context $context
     * @param CatalogRuleRepositoryInterface $ruleRepository
     * @param RequestInterface $request
     */
    public function __construct(
        Context $context,
        CatalogRuleRepositoryInterface $ruleRepository,
        RequestInterface $request
    ) {
        parent::__construct($context);
        $this->ruleRepository = $ruleRepository;
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

            $rule = $this->ruleRepository->get($id);

            $clone = clone $rule;
            $clone->setName(sprintf('%s (copy)', $rule->getName()));
            $clone->setId(0);
            $clone->setIsActive(0);

            if ($clone->save()) {
                $this->messageManager->addSuccessMessage(
                    __('The catalog rule (%1) has been duplicated.', $rule->getName())
                );
            }

        } catch (\Exception $e) {

            $this->messageManager->addErrorMessage(
                __('Something went wrong while saving the rule data. Please review the error log.')
            );
        }

        $this->_redirect('catalog_rule/promo_catalog/');
    }
}
