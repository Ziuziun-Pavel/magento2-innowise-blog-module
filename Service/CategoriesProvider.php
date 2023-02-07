<?php

declare(strict_types=1);

namespace Innowise\Blog\Service;

use Innowise\Blog\Model\ResourceModel\Category\Collection;
use Innowise\Blog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\DB\Select;

class CategoriesProvider
{
    public function __construct(private CollectionFactory $collectionFactory) {}

    public function getCategories(): Collection
    {
        $collection = $this->getCollection();
        $collection->setOrder('created_at', Select::SQL_DESC);

        return $collection;
    }

    private function getCollection(): Collection
    {
        return $this->collectionFactory->create();
    }

}
