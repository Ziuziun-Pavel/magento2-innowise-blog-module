<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    private const TABLE_NAME = 'innowise_blog_post';
    private const PRIMARY_KEY = 'post_id';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::PRIMARY_KEY);
    }
}
