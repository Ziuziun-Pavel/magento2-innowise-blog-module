<?php

declare(strict_types=1);

namespace Innowise\Blog\ViewModel;

use Innowise\Blog\Service\CategoriesProvider;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class CategoryViewModel implements ArgumentInterface
{
    public function __construct(
        private CategoriesProvider $categoriesProvider,
    )
    { }

    public function getCategories(): \Innowise\Blog\Model\ResourceModel\Category\Collection
    {
        return $this->categoriesProvider->getCategories();
    }

}
