<?php

declare(strict_types=1);

namespace Innowise\Blog\Controller\Adminhtml\Category;

use Innowise\Blog\Api\Data\CategoryInterface;
use Innowise\Blog\Controller\Adminhtml\AbstractCategory;
use Innowise\Blog\Model\ResourceModel\Category\CategoryRepository;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

class Delete extends AbstractCategory
{
    /**
     * @var CategoryRepository
     */
    private CategoryRepository $categoryRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(
        Context $context,
        CategoryRepository $categoryRepository,
        LoggerInterface $logger
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->logger = $logger;

        parent::__construct($context);
    }

    public function execute()
    {
        if ($categoryId = (int)$this->getRequest()->getParam(CategoryInterface::CATEGORY_ID)) {
            try {
                $this->categoryRepository->deleteById($categoryId);
                $this->messageManager->addSuccessMessage(__('You deleted the category.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('We can\'t delete category right now. Please review the log and try again.')
                );
                $this->logger->critical($e);
            }
        }

        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
