<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Post;

use Innowise\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Stdlib\DateTime as LibDateTime;
use Magento\Framework\Stdlib\DateTime\DateTime;

class Post extends AbstractDb
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $dateTime;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;


    public const POST_TABLE = 'innowise_blog_post';

    public function __construct(
        Context $context,
        DateTime $date,
        LibDateTime $dateTime,
    ) {
        $this->dateTime = $dateTime;
        $this->date = $date;

        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::POST_TABLE, PostInterface::POST_ID);
    }

    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        foreach (['store_ids'] as $field) {
            $value = !$object->getData($field) ? null : $object->getData($field);
            $object->setData($field, $this->dateTime->formatDate($value));
        }
        foreach (['category_ids'] as $field) {
            if (is_array($object->getData($field))) {
                $object->setData($field, implode(',', $object->getData($field)));
            }
        }
        foreach (['tags'] as $field) {
            if (is_array($object->getData($field))) {
                $object->setData($field, implode(',', $object->getData($field)));
            }
        }
        $object->setUpdatedAt($this->date->gmtDate());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->date->gmtDate());
        }

        return parent::_beforeSave($object);
    }
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($object->getId()) {
            $storeIds = $this->lookupStoreIds($object->getId());
            $categoryIds = $this->lookupCategoryIds($object->getId());
            $tags = $this->lookupTags($object->getId());

            $object->setData('store_ids', $storeIds);
            $object->setData('category_ids', $categoryIds);
            $object->setData('tags', $tags);
        }

        return parent::_afterLoad($object);
    }
    public function lookupStoreIds($postId)
    {
        $adapter = $this->getConnection();

        $select = $adapter->select()->from(
            $this->getTable('innowise_blog_post_store'),
            'store_id'
        )->where(
            'post_id = ?',
            (int)$postId
        );

        return $adapter->fetchCol($select);
    }

    public function lookupCategoryIds($postId)
    {
        $adapter = $this->getConnection();

        $select = $adapter->select()->from(
            $this->getTable('innowise_blog_post_category'),
            'category_id'
        )->where(
            'post_id = ?',
            (int)$postId
        );

        return $adapter->fetchCol($select);
    }

    public function lookupTags($postId)
    {
        $adapter = $this->getConnection();

        $select = $adapter->select()->from(
            $this->getTable('innowise_blog_post_tags'),
            'tag_id'
        )->where(
            'post_id = ?',
            (int)$postId
        );

        return $adapter->fetchCol($select);
    }
}
