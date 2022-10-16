<?php
declare(strict_types=1);

/**
 * Magenizr Duplicate
 * @copyright   Copyright (c) 2018 - 2022 Magenizr (https://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\Duplicate\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Api\CategoryRepositoryInterface;

class Duplicate extends \Magento\Backend\App\Action
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * Init constructor
     *
     * @param Context $context
     * @param CategoryRepositoryInterface $categoryRepository
     * @param RequestInterface $request
     */
    public function __construct(
        Context $context,
        CategoryRepositoryInterface $categoryRepository,
        RequestInterface $request
    ) {
        parent::__construct($context);
        $this->categoryRepository = $categoryRepository;
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

            $category = $this->categoryRepository->get($id);

            $clone = clone $category;
            $clone->setId(0);
            $clone->setIsActive(0);
            $clone->setName(sprintf('%s (copy)', $category->getName()));
            $clone->setUrlKey(sprintf('%s-copy', $category->getUrlKey()));

            $clone->setPath($category->getPath());

            if ($clone->save()) {
                $this->messageManager->addSuccessMessage(
                    __('The category (%1) has been duplicated.', $category->getName())
                );
            }

        } catch (\Exception $e) {

            $this->messageManager->addErrorMessage(
                __('Something went wrong while saving the category. Please review the error log.')
            );
        }

        $this->_redirect('catalog/category/');
    }
}
