<?php

declare(strict_types=1);

namespace Innowise\Blog\ViewModel;

use Innowise\Blog\Api\Data\CategorySearchResultsInterface;
use Innowise\Blog\Service\CategoriesProvider;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CategoryViewModel implements ArgumentInterface
{
    public function __construct(
        private CategoriesProvider $categoriesProvider,
    )
    { }

    public function getCategories(): CategorySearchResultsInterface|SearchResults
    {
        return $this->categoriesProvider->getCategories();
    }
}
