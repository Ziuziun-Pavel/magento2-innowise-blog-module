<?php
declare(strict_types=1);

namespace Innowise\Blog\Service;

use Innowise\Blog\Api\Data\CategoryInterface;
use Innowise\Blog\Api\CategoryRepositoryInterface;

class CategoryIdChecker
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    )
    { }

    public function checkUrlKey(string $urlKey): int
    {
        $category = $this->categoryRepository->getByUrlKey($urlKey);

        if ($category instanceof CategoryInterface) {
            return (int) $category->getId();
        }

        return 0;
    }
}
