<?php

declare(strict_types=1);

namespace Innowise\Blog\Service;

use Innowise\Blog\Api\PostRepositoryInterface;
use Innowise\Blog\Api\Data\PostSearchResultsInterface;
use Innowise\Blog\Model\ResourceModel\Post\Collection;
use Innowise\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\DB\Select;

class PostsProvider
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
    ) {}

    public function getPosts(int $limit, int $currentPage): PostSearchResultsInterface|\Magento\Framework\Api\SearchResults
    {
//        $collection = $this->getCollection();
//        $collection->setOrder('created_at', Select::SQL_DESC);
//        $collection->setPageSize($limit);
//        $collection->setCurPage($currentPage);
//
//        return $collection;
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchCriteria->setFilterGroups(null);
        $searchCriteria->setPageSize($limit);
        $searchCriteria->setCurrentPage($currentPage);
        $searchResults = $this->postRepository->getList($searchCriteria);
        $posts = $searchResults;

        return $posts;
    }

//    private function getCollection(): Collection
//    {
//        return $this->collectionFactory->create();
//    }

}
