<?php

declare(strict_types=1);

namespace Innowise\Blog\ViewModel;

use Innowise\Blog\Api\Data\CategorySearchResultsInterface;
use Innowise\Blog\Service\CategoriesProvider;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Innowise\Blog\Model\Category;
use Magento\Framework\UrlInterface;

class CategoryViewModel implements ArgumentInterface
{
    public function __construct(
        private CategoriesProvider $categoriesProvider,
        private UrlInterface $url
    )
    { }

    public function getCategories(): CategorySearchResultsInterface|SearchResults
    {
        return $this->categoriesProvider->getCategories();
    }

    public function getCategoryUrl(Category $category): string
    {
        return $this->url->getBaseUrl() . 'blog/' . $category->getData('url_key');
    }
}
