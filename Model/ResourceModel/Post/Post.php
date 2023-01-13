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
}
