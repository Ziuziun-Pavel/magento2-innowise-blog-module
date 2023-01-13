<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Category;

use Innowise\Blog\Api\CategoryRepositoryInterface;
use Innowise\Blog\Api\Data\CategoryInterface;
use Innowise\Blog\Api\Data\CategoryInterfaceFactory;
use Innowise\Blog\Api\Data\CategorySearchResultsInterface;
use Innowise\Blog\Api\Data\CategorySearchResultsInterfaceFactory;
use Innowise\Blog\Model\Category as CategoryModel;
use Innowise\Blog\Model\ResourceModel\Category\Category as CategoryResourceModel;
use Innowise\Blog\Model\ResourceModel\Category\Collection as CategoryCollection;
use Innowise\Blog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var CategorySearchResultsInterfaceFactory
     */
    private CategorySearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * @var CategoryResourceModel
     */
    private Category $categoryResource;

    /**
     * @var CollectionFactory
     */
    private \Innowise\Blog\Model\ResourceModel\Category\CollectionFactory $collectionFactory;

    /**
     * @var CategoryInterfaceFactory
     */
    private CategoryInterfaceFactory $categoryInterfaceFactory;

    /**
     * @var DataObjectHelper
     */
    private DataObjectHelper $dataObjectHelper;

    /**
     * @var JoinProcessorInterface
     */
    private $extensionAttributesJoinProcessor;

    /**
     * @var CollectionProcessorInterface
     */
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @var DataObjectProcessor
     */
    private DataObjectProcessor $dataObjectProcessor;

    public function __construct(
        CategorySearchResultsInterfaceFactory $searchResultsFactory,
        CategoryResourceModel $categoryResource,
        CollectionFactory $collectionFactory,
        CategoryInterfaceFactory $categoryInterfaceFactory,
        DataObjectHelper $dataObjectHelper,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        CollectionProcessorInterface $collectionProcessor,
        DataObjectProcessor $dataObjectProcessor
    ) {
        $this->searchResultsFactory = $searchResultsFactory;
        $this->categoryResource = $categoryResource;
        $this->collectionFactory = $collectionFactory;
        $this->categoryInterfaceFactory = $categoryInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    public function getById(int $categoryId): CategoryInterface
    {
        if (!isset($this->registry[$categoryId])) {
            /** @var CategoryInterface $category */
            $category = $this->categoryInterfaceFactory->create();
            $this->categoryResource->load($category, $categoryId);
            if (!$category->getId()) {
                throw NoSuchEntityException::singleField('id', $categoryId);
            }
            $this->registry[$categoryId] = $category;
        }

        return $this->registry[$categoryId];
    }

    public function save(CategoryInterface $category): CategoryInterface
    {
        try {
            $this->categoryResource->save($category);
            $this->registry[$category->getId()] = $category;
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $category;
    }

    public function delete(CategoryInterface $category): bool
    {
        try {
            $this->categoryResource->delete($category);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        if (isset($this->registry[$category->getId()])) {
            unset($this->registry[$category->getId()]);
        }

        return true;
    }

    public function deleteById(int $categoryId): bool
    {
        return $this->delete($this->getById($categoryId));
    }

    public function getList(SearchCriteriaInterface $searchCriteria): CategorySearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());

        $objects = [];
        /** @var CategoryModel $item */
        foreach ($collection->getItems() as $item) {
            $objects[] = $this->getDataObject($item);
        }
        $searchResults->setItems($objects);

        return $searchResults;
    }

    private function getDataObject(CategoryModel $model): CategoryInterface
    {
        $object = $this->categoryInterfaceFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $object,
            $this->dataObjectProcessor->buildOutputDataArray($model, CategoryInterface::class),
            CategoryInterface::class
        );

        return $object;
    }
}
