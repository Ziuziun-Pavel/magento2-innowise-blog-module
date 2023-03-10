<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Post;

use Aws\Api\AbstractModel;
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
        LibDateTime $dateTime
    ) {
        $this->dateTime = $dateTime;
        $this->date = $date;

        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::POST_TABLE, PostInterface::POST_ID);
    }

    /**
     * {@inheritdoc}
     */
    protected function _afterSave(AbstractModel|\Magento\Framework\Model\AbstractModel $post)
    {
        /** @var PostInterface $post */
        $this->saveCategoryIds($post);
        $this->saveStoreIds($post);
        $this->saveTags($post);

        return parent::_afterSave($post);
    }

    /**
     * @param PostInterface $model
     *
     * @return $this
     */
    private function saveCategoryIds(PostInterface $model)
    {
        $connection = $this->getConnection();

        $table = $this->getTable('innowise_blog_post_category');

        if (!$model->getCategoryIds()) {
            return $this;
        }

        $categoryIds    = $model->getCategoryIds();
        $oldCategoryIds = $this->lookupCategoryIds($model);

        $insert = array_diff($categoryIds, $oldCategoryIds);
        $delete = array_diff($oldCategoryIds, $categoryIds);

        if (!empty($insert)) {
            $data = [];
            foreach ($insert as $categoryId) {
                if (empty($categoryId)) {
                    continue;
                }

                $data[] = [
                    'category_id' => (int)$categoryId,
                    'post_id'     => (int)$model->getId(),
                ];
            }

            if ($data) {
                $connection->insertMultiple($table, $data);
            }
        }

        if (!empty($delete)) {
            foreach ($delete as $categoryId) {
                $where = ['post_id = ?' => (int)$model->getId(), 'category_id = ?' => (int)$categoryId];
                $connection->delete($table, $where);
            }
        }

        return $this;
    }

    /**
     * @param PostInterface $model
     *
     * @return $this
     */
    private function saveStoreIds(PostInterface $model)
    {
        $connection = $this->getConnection();

        $table = $this->getTable('innowise_blog_post_store');

        if (!$model->getStoreIds()) {
            return $this;
        }

        $storeIds    = $model->getStoreIds();
        $oldStoreIds = $this->lookupStoreIds($model);

        $insert = array_diff($storeIds, $oldStoreIds);
        $delete = array_diff($oldStoreIds, $storeIds);

        if (!empty($insert)) {
            $data = [];
            foreach ($insert as $storeId) {
                if (empty($storeId)) {
                    continue;
                }
                $data[] = [
                    'store_id' => (int)$storeId,
                    'post_id'  => (int)$model->getId(),
                ];
            }

            if ($data) {
                $connection->insertMultiple($table, $data);
            }
        }

        if (!empty($delete)) {
            foreach ($delete as $storeId) {
                $where = ['post_id = ?' => (int)$model->getId(), 'store_id = ?' => (int)$storeId];
                $connection->delete($table, $where);
            }
        }

        return $this;
    }

    /**
     * @param PostInterface $model
     *
     * @return $this
     */
    private function saveTags(PostInterface $model)
    {
        $connection = $this->getConnection();

        $table = $this->getTable('innowise_blog_post_tag');

        if (!$model->getTags()) {
            return $this;
        }

        $tagIds    = $model->getTags();
        $oldTagIds = $this->lookupTags($model);

        $insert = array_diff($tagIds, $oldTagIds);
        $delete = array_diff($oldTagIds, $tagIds);

        if (!empty($insert)) {
            $data = [];
            foreach ($insert as $tagId) {
                if (empty($tagId)) {
                    continue;
                }
                $data[] = [
                    'tag_id'  => (int)$tagId,
                    'post_id' => (int)$model->getId(),
                ];
            }

            if ($data) {
                $connection->insertMultiple($table, $data);
            }
        }

        if (!empty($delete)) {
            foreach ($delete as $tagId) {
                $where = ['post_id = ?' => (int)$model->getId(), 'tag_id = ?' => (int)$tagId];
                $connection->delete($table, $where);
            }
        }

        return $this;
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

    private function lookupStoreIds($postId)
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

    private function lookupCategoryIds($postId)
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

    private function lookupTags($postId)
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
