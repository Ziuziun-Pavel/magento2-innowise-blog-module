<?php

namespace Innowise\Blog\Api\Data;

interface PostInterface
{
    /**
     * Constants used as data array keys
     */
    const POST_ID = 'post_id';
    const TITLE = 'title';
    const CONTENT = 'content';
    const STORE_IDS = 'store_ids';
    const STATUS = 'status';
    const URL_KEY = 'url_key';
    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
    const CATEGORY_IDS = 'category_ids';
    const TAGS = 'tags';

    const ATTRIBUTES = [
        self::POST_ID,
        self::TITLE,
        self::CONTENT,
        self::STORE_IDS,
        self::STATUS,
        self::URL_KEY,
        self::UPDATED_AT,
        self::CREATED_AT,
        self::CATEGORY_IDS,
        self::TAGS,
    ];

    /**
     * Get Post id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set Post id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * Get Post Title
     *
     * @return string/null
     */
    public function getTitle();

    /**
     * Set Post Title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title);

    /**
     * Get Post Content
     *
     * @return string/null
     */
    public function getContent();

    /**
     * Set Post Content
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content);

    /**
     * Get Post Store Id
     *
     * @return int/null
     */
    public function getStoreIds();

    /**
     * Set Post Store Id
     *
     * @param int $storeId
     *
     * @return $this
     */
    public function setStoreIds($storeId);

    /**
     * Get Post Status
     *
     * @return int/null
     */
    public function getStatus();

    /**
     * Set Post Status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get Post Url Key
     *
     * @return string/null
     */
    public function getUrlKey();

    /**
     * Set Post Url Key
     *
     * @param string $url
     *
     * @return $this
     */
    public function setUrlKey($url);

    /**
     * Get Post created date
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get Post updated date
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set Post updated date
     *
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get Post Category Ids
     *
     * @return int[]|null
     */
    public function getCategoryIds();

    /**
     * @param int[] $array
     *
     * @return $this
     */
    public function setCategoryIds($array);

    /**
     * Get Post Tags
     *
     * @return int[]|null
     */
    public function getTags();

    /**
     * @param string[] $array
     *
     * @return $this
     */
    public function setTags($array);
}
