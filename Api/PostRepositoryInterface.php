<?php

declare(strict_types=1);

namespace Innowise\Blog\Api;

use Innowise\Blog\Api\Data\PostInterface;
use Innowise\Blog\Api\Data\PostSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PostRepositoryInterface
{
    /**
     * Save post.
     *
     * @param PostInterface $post
     * @return PostInterface
     * @throws LocalizedException
     */
    public function save(PostInterface $post): PostInterface;

    /**
     * Retrieve post.
     *
     * @param int $postId
     * @return PostInterface
     * @throws LocalizedException
     */
    public function getById(int $postId): PostInterface;

    /**
     * Get post by URL key
     * @param string $url_key
     * @return PostInterface|null
     * @throws NoSuchEntityException
     */
    public function getByUrlKey(string $url_key): ?PostInterface;

    /**
     * Retrieve posts matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): PostSearchResultsInterface|\Magento\Framework\Api\SearchResults;

    /**
     * Delete post.
     *
     * @param PostInterface $post
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(PostInterface $post): bool;

    /**
     * Delete post by ID.
     *
     * @param int $postId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $postId): bool;
}
