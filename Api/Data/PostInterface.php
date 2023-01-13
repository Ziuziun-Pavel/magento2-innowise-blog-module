<?php

namespace Innowise\Blog\Api\Data;

use Magento\Tests\NamingConvention\true\string;

interface PostInterface
{
    /**
     * Constants used as data array keys
     */
    public const POST_ID = 'post_id';
    public const POST_TITLE = 'title';
    public const POST_CONTENT = 'content';
    public const POST_STATUS = 'status';
    public const POST_URL_KEY = 'url_key';
    public const POST_CATEGORY_IDS = 'category_ids';
    public const POST_TAGS = 'tags';
    public const POST_STORE_IDS = 'store_ids';
    public const POST_UPDATED_AT = 'updated_at';
    public const POST_CREATED_AT = 'created_at';

    /**
     * Get Post id
     *
     * @return int
     */
    public function getPostId(): int;

    /**
     * Set Post id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setPostId(int $id): PostInterface;

    /**
     * Get Post Title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Set Post Title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): PostInterface;

    /**
     * Get Post Content
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Set Post Content
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent(string $content): PostInterface;

    /**
     * Get Post Store Id
     *
     * @return int[]
     */
    public function getStoreIds(): array;

    /**
     * Set Post Store Id
     *
     * @param int $storeId
     *
     * @return $this
     */
    public function setStoreIds(int $storeId): PostInterface;

    /**
     * Get Post Status
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Set Post Status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus(int $status): PostInterface;

    /**
     * Get Post Url Key
     *
     * @return string
     */
    public function getUrlKey(): string;

    /**
     * Set Post Url Key
     *
     * @param string $urlKey
     *
     * @return $this
     */
    public function setUrlKey(string $urlKey): PostInterface;

    /**
     * Get Post created date
     *
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * Set Category created date
     *
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(string $createdAt): PostInterface;

    /**
     * Get Post updated date
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set Post updated date
     *
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): PostInterface;

    /**
     * Get Post Category Ids
     *
     * @return int[]
     */
    public function getCategoryIds(): array;

    /**
     * @param int[] $array
     *
     * @return $this
     */
    public function setCategoryIds(array $array): PostInterface;

    /**
     * Get Post Tags
     *
     * @return string[]
     */
    public function getTags(): array;

    /**
     * @param string[] $array
     *
     * @return $this
     */
    public function setTags(array $array): PostInterface;
}
