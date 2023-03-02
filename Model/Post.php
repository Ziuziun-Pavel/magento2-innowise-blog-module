<?php

declare(strict_types=1);

namespace Innowise\Blog\Model;

use Innowise\Blog\Api\Data\PostInterface;
use Innowise\Blog\Model\ResourceModel\Post\Post as ResourceModel;
use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel implements PostInterface
{
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    public function getPostId(): int
    {
        return (int)$this->getData(PostInterface::POST_ID);
    }

    public function setPostId(int $id): PostInterface
    {
        return $this->setData(PostInterface::POST_ID, $id);
    }

    public function getStatus(): int
    {
        return (int)$this->getData(PostInterface::POST_STATUS);
    }

    public function setStatus(int $status): PostInterface
    {
        return $this->setData(PostInterface::POST_STATUS, $status);
    }

    public function getTitle(): string
    {
        return (string)$this->getData(PostInterface::POST_TITLE);
    }

    public function setTitle(string $title): PostInterface
    {
        return $this->setData(PostInterface::POST_TITLE, $title);
    }

    public function getUrlKey(): string
    {
        return (string)$this->getData(PostInterface::POST_URL_KEY);
    }

    public function setUrlKey(string $urlKey): PostInterface
    {
        return $this->setData(PostInterface::POST_URL_KEY, $urlKey);
    }

    public function getContent(): string
    {
        return (string)$this->getData(PostInterface::POST_CONTENT);
    }

    public function setContent(string $content): PostInterface
    {
        return $this->setData(PostInterface::POST_CONTENT, $content);
    }

    public function getCreatedAt(): string
    {
        return (string)$this->getData(PostInterface::POST_CREATED_AT);
    }

    public function setCreatedAt(string $createdAt): PostInterface
    {
        return $this->setData(PostInterface::POST_CREATED_AT, $createdAt);
    }

    public function getStoreIds(): array
    {
        return explode(',',$this->getData(PostInterface::POST_STORE_IDS));
    }

    public function setStoreIds(array $storeIds): PostInterface
    {
        return $this->setData(PostInterface::POST_STORE_IDS, $storeIds);
    }

    public function getUpdatedAt(): string
    {
        return (string)$this->getData(PostInterface::POST_UPDATED_AT);
    }

    public function setUpdatedAt(string $updatedAt): PostInterface
    {
        return $this->setData(PostInterface::POST_UPDATED_AT, $updatedAt);
    }

    public function getCategoryIds(): array
    {
        return explode(',',$this->getData(PostInterface::POST_CATEGORY_IDS));
    }

    public function setCategoryIds(array $categoryIds): PostInterface
    {
        return $this->setData(PostInterface::POST_CATEGORY_IDS, $categoryIds);
    }

    public function getTags(): array
    {
        return explode(',', $this->getData(PostInterface::POST_TAGS));
    }

    public function setTags(array $tags): PostInterface
    {
        return $this->setData(PostInterface::POST_TAGS, $tags);
    }
}
