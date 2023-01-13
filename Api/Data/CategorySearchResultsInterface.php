<?php

declare(strict_types=1);

namespace Innowise\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CategorySearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get categories list.
     *
     * @return CategoryInterface[]
     */
    public function getItems(): array;

    /**
     * Set categories list.
     *
     * @param CategoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items): CategorySearchResultsInterface;
}
