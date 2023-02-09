<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Category;

use Innowise\Blog\Api\Data\CategoryInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Category extends AbstractDb
{
    public const CATEGORY_TABLE = 'innowise_blog_category';

    protected function _construct()
    {
        $this->_init(self::CATEGORY_TABLE, CategoryInterface::CATEGORY_ID);
    }
}
