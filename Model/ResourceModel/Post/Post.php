<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Post;

use Innowise\Blog\Api\Data\PostInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    public const POST_TABLE = 'innowise_blog_post';

    protected function _construct()
    {
        $this->_init(self::POST_TABLE, PostInterface::POST_ID);
    }

    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        $select->join(
            array('innowise_blog_post_category' => $this->getTable('innowise_blog_post_category')),
            'innowise_blog_post.post_id=innowise_blog_post_category.category_id',
            array());

        $select->join(
            array('innowise_blog_category'=>$this->getTable('innowise_blog_category')),
            'innowise_blog_post.category_id=innowise_blog_category.category_id',
            array());

        return $select;
    }

}
