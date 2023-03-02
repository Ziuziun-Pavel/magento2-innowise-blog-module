<?php
declare(strict_types=1);

namespace Innowise\Blog\Service;

use Innowise\Blog\Api\Data\PostInterface;
use Innowise\Blog\Api\PostRepositoryInterface;

class PostIdChecker
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    )
    { }

    public function checkUrlKey(string $urlKey): int
    {
        $post = $this->postRepository->getByUrlKey($urlKey);

        if ($post instanceof PostInterface) {
            return (int) $post->getId();
        }

        return 0;
    }
}
