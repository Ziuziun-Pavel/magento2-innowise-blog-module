<?php

declare(strict_types=1);

namespace Innowise\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PostSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get posts list.
     *
     * @return PostInterface[]
     */
    public function getItems(): array;

    /**
     * Set posts list.
     *
     * @param PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items): PostSearchResultsInterface;
}
