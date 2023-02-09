<?php

declare(strict_types=1);

namespace Innowise\Blog\Api;

use Innowise\Blog\Api\Data\CategoryInterface;
use Innowise\Blog\Api\Data\CategorySearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface CategoryRepositoryInterface
{
    /**
     * Save category.
     *
     * @param CategoryInterface $category
     * @return CategoryInterface
     * @throws LocalizedException
     */
    public function save(CategoryInterface $category): CategoryInterface;

    /**
     * Retrieve category.
     *
     * @param int $categoryId
     * @return CategoryInterface
     * @throws LocalizedException
     */
    public function getById(int $categoryId): CategoryInterface;

    /**
     * Retrieve categories matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return CategorySearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): Data\CategorySearchResultsInterface;

    /**
     * Delete category.
     *
     * @param CategoryInterface $category
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(CategoryInterface $category): bool;

    /**
     * Delete category by ID.
     *
     * @param int $categoryId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $categoryId): bool;
}
