<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Post;

use Innowise\Blog\Model\Post as Model;
use Innowise\Blog\Model\ResourceModel\Post\Post as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

abstract class Collection extends AbstractCollection
{

    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
