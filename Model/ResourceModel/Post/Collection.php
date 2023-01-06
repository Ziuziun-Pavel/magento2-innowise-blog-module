<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Innowise\Blog\Model\Post;
use Innowise\Blog\Model\ResourceModel\Post as PostResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Post::class, PostResource::class);
    }
}
