<?php

declare(strict_types=1);

namespace Innowise\Blog\Service;

use Innowise\Blog\Api\CategoryRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Innowise\Blog\Api\Data\CategorySearchResultsInterface;

class CategoriesProvider
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
    ) {}

    public function getCategories(): CategorySearchResultsInterface|\Magento\Framework\Api\SearchResults
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResults = $this->categoryRepository->getList($searchCriteria);
        $categories = $searchResults;

        return $categories;
    }
}
