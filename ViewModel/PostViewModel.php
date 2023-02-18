<?php

declare(strict_types=1);

namespace Innowise\Blog\ViewModel;

use Innowise\Blog\Api\PostRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Innowise\Blog\Model\Post;
use Magento\Framework\UrlInterface;
class PostViewModel implements ArgumentInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepositoryInterface,
        private RequestInterface $requestInterface,
        private UrlInterface $url
    ) { }

    public function getPost()
    {
        $id = (int) $this->requestInterface->getParam('post_id');

        return $this->postRepositoryInterface->getById($id);
    }

    public function getPostUrl(Post $post): string
    {
        return $this->url->getBaseUrl() . 'blog/' . $post->getData('url_key');
    }
}
