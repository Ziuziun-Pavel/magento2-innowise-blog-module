<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Post;

use Innowise\Blog\Api\Data\PostInterface;
use Innowise\Blog\Api\Data\PostInterfaceFactory;
use Innowise\Blog\Api\Data\PostSearchResultsInterface;
use Innowise\Blog\Api\Data\PostSearchResultsInterfaceFactory;
use Innowise\Blog\Api\PostRepositoryInterface;
use Innowise\Blog\Model\Post as PostModel;
use Innowise\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use Innowise\Blog\Model\ResourceModel\Post\CollectionFactory;
use Innowise\Blog\Model\ResourceModel\Post\Post as PostResourceModel;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PostSearchResultsInterfaceFactory
     */
    private PostSearchResultsInterfaceFactory $searchResultsFactory;

    /**
     * @var PostResourceModel
     */
    private Post $postResource;

    /**
     * @var CollectionFactory
     */
    private \Innowise\Blog\Model\ResourceModel\Post\CollectionFactory $collectionFactory;

    /**
     * @var PostInterfaceFactory
     */
    private PostInterfaceFactory $postInterfaceFactory;

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
        PostSearchResultsInterfaceFactory $searchResultsFactory,
        PostResourceModel $postResource,
        CollectionFactory $collectionFactory,
        PostInterfaceFactory $postInterfaceFactory,
        DataObjectHelper $dataObjectHelper,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        CollectionProcessorInterface $collectionProcessor,
        DataObjectProcessor $dataObjectProcessor,
        private SearchCriteriaBuilder $searchCriteriaBuilder

    ) {
        $this->searchResultsFactory = $searchResultsFactory;
        $this->postResource = $postResource;
        $this->collectionFactory = $collectionFactory;
        $this->postInterfaceFactory = $postInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->collectionProcessor = $collectionProcessor;
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    public function getByUrlKey(string $url_key): int
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $posts = $this->getList($searchCriteria);

        foreach ($posts->getItems() as $post) {
            if ($post->getUrlKey() == $url_key) {
                return $post->getPostId();
            }
        }
        throw new NoSuchEntityException(__('Unable to find entity with ID "%1"', $url_key));
    }


    public function getById(int $postId): PostInterface
    {
        if (!isset($this->registry[$postId])) {
            $post = $this->postInterfaceFactory->create();
            $this->postResource->load($post, $postId);
            if (!$post->getId()) {
                throw NoSuchEntityException::singleField('id', $postId);
            }
            $this->registry[$postId] = $post;
        }

        return $this->registry[$postId];
    }

    public function save(PostInterface $post): PostInterface
    {
        try {
            $this->postResource->save($post);
            $this->registry[$post->getId()] = $post;
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $post;
    }

    public function delete(PostInterface $post): bool
    {
        try {
            $this->postResource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        if (isset($this->registry[$post->getId()])) {
            unset($this->registry[$post->getId()]);
        }

        return true;
    }

    public function deleteById(int $postId): bool
    {
        return $this->delete($this->getById($postId));
    }

    public function getList(SearchCriteriaInterface $searchCriteria): PostSearchResultsInterface|\Magento\Framework\Api\SearchResults
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setTotalCount($collection->getSize());

        $objects = [];
        /** @var PostModel $item */
        foreach ($collection->getItems() as $item) {
            $objects[] = $this->getDataObject($item);
        }
        $searchResults->setItems($objects);

        return $searchResults;
    }

    private function getDataObject(PostModel $model): PostInterface
    {
        $object = $this->postInterfaceFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $object,
            $this->dataObjectProcessor->buildOutputDataArray($model, PostInterface::class),
            PostInterface::class
        );

        return $object;
    }
}
