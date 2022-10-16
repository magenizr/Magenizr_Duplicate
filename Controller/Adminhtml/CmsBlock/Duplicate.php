<?php
declare(strict_types=1);

/**
 * Magenizr Duplicate
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\Duplicate\Controller\Adminhtml\CmsBlock;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Cms\Model\Block;

class Duplicate extends \Magento\Backend\App\Action
{
    /**
     * @var Block
     */
    protected $block;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Init constructor
     *
     * @param Context $context
     * @param Block $block
     * @param RequestInterface $request
     */
    public function __construct(
        Context $context,
        Block $block,
        RequestInterface $request
    ) {
        parent::__construct($context);
        $this->block = $block;
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

            $block = $this->block->load($id);

            $clone = clone $block;
            $clone->setTitle(sprintf('%s (copy)', $block->getTitle()));
            $clone->setBlockId(0);
            $clone->setIdentifier(sprintf('%s_copy', $block->getIdentifier()));
            $clone->setIsActive(0);

            if ($clone->save()) {
                $this->messageManager->addSuccessMessage(
                    __('The cms block (%1) has been duplicated.', $block->getTitle())
                );
            }

        } catch (\Exception $e) {

            $this->messageManager->addErrorMessage(
                __('Something went wrong while saving the cms block. Please review the error log.')
            );
        }

        $this->_redirect('cms/block/');
    }
}
