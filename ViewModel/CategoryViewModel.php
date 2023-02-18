<?php

declare(strict_types=1);

namespace Innowise\Blog\ViewModel;

use Innowise\Blog\Api\Data\CategorySearchResultsInterface;
use Innowise\Blog\Api\Data\PostSearchResultsInterface;
use Innowise\Blog\Model\Post;
use Innowise\Blog\Service\CategoriesProvider;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Innowise\Blog\Model\Category;
use Magento\Framework\UrlInterface;
use Innowise\Blog\Api\CategoryRepositoryInterface;
use Innowise\Blog\Api\Data\PostInterface;
use Innowise\Blog\Api\PostRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;

class CategoryViewModel implements ArgumentInterface
{
    private CategorySearchResultsInterface|SearchResults $categoryPosts ;

    public function __construct(
        private CategoriesProvider $categoriesProvider,
        private CategoryRepositoryInterface $categoryRepositoryInterface,
        private RequestInterface $requestInterface,
        private UrlInterface $url,
        private CategoryRepositoryInterface $categoryRepository,
        private PostRepositoryInterface $postRepository,
        private SearchCriteriaBuilder $searchCriteriaBuilder,
        private SortOrderBuilder $sortOrderBuilder
    )
    {  }

    public function getCategories(): CategorySearchResultsInterface|SearchResults
    {
        return $this->categoriesProvider->getCategories();
    }

    public function getCategoryUrl(Category $category): string
    {
        return $this->url->getBaseUrl() . 'blog/' . $category->getData('url_key');
    }

    public function getCategory()
    {
        $id = (int) $this->requestInterface->getParam('category_id');

        return $this->categoryRepositoryInterface->getById($id);
    }

    public function getCategoryPosts(): PostSearchResultsInterface|SearchResults
    {
        $categoryId = (int) $this->requestInterface->getParam('category_id');

        $category = $this->categoryRepository->getById($categoryId);

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(PostInterface::POST_CATEGORY_IDS, $category->getId())
            ->create();

        $sortOrder = $this->sortOrderBuilder
            ->setField(PostInterface::POST_CREATED_AT)
            ->setDescendingDirection()
            ->create();

        $searchCriteria->setSortOrders([$sortOrder]);

        $this->categoryPosts = $this->postRepository->getList($searchCriteria);

        return $this->categoryPosts;
    }

    public function getPostHtml(Template $block, Post $post): string
    {
        $block->setData('post', $post);
        return $block->toHtml();
    }

}
