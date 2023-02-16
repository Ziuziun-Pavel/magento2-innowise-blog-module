<?php

declare(strict_types=1);

namespace Innowise\Blog\Service;

use Innowise\Blog\Api\PostRepositoryInterface;
use Innowise\Blog\Api\Data\PostSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;

class PostsProvider
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
    ) {}

    public function getPosts(int $limit, int $currentPage): PostSearchResultsInterface|\Magento\Framework\Api\SearchResults
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchCriteria->setFilterGroups(null);
        $searchCriteria->setPageSize($limit);
        $searchCriteria->setCurrentPage($currentPage);
        $searchResults = $this->postRepository->getList($searchCriteria);
        $posts = $searchResults;

        return $posts;
    }
}
