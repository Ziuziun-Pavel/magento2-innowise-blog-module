<?php

declare(strict_types=1);

namespace Innowise\Blog\Api\Data;

interface CategoryInterface
{
    public const CATEGORY_ID = 'category_id';
    public const CATEGORY_TITLE = 'title';
    public const CATEGORY_STATUS = 'status';
    public const CATEGORY_URL_KEY = 'url_key';
    public const CATEGORY_CONTENT = 'description';
    public const CATEGORY_CREATED_AT = 'created_at';
    public const CATEGORY_UPDATED_AT = 'updated_at';

    /**
     * Get Category id
     *
     * @return int
     */
    public function getCategoryId(): int;

    /**
     * Set Category id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setCategoryId(int $id): CategoryInterface;

    /**
     * Get Category Status
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Set Category Status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus(int $status): CategoryInterface;

    /**
     * Get Category Title
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Set Category Title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): CategoryInterface;

    /**
     * Get Category Url Key
     *
     * @return string
     */
    public function getUrlKey(): string;

    /**
     * Set Category Url Key
     *
     * @param string $urlKey
     *
     * @return $this
     */
    public function setUrlKey(string $urlKey): CategoryInterface;

    /**
     * Get Category Content
     *
     * @return string
     */
    public function getContent(): string;

    /**
     * Set Category Content
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent(string $content): CategoryInterface;

    /**
     * Get Category created date
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
    public function setCreatedAt(string $createdAt): CategoryInterface;

    /**
     * Get Category updated date
     *
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * Set Category updated date
     *
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(string $updatedAt): CategoryInterface;
}
