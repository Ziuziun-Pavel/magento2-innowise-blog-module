<?php
declare(strict_types=1);

namespace Innowise\Blog\Service;

use Innowise\Blog\Api\PostRepositoryInterface;
use Innowise\Blog\Model\ResourceModel\Post\Post;

class PostIdChecker
{
    public function __construct(
        private PostRepositoryInterface $postRepositoryInterface
    )
    { }

    public function checkUrlKey(string $urlKey): int
    {
        var_dump($this->postRepositoryInterface->getByUrlKey($urlKey));
        return $this->postRepositoryInterface->getByUrlKey($urlKey);
    }
}
