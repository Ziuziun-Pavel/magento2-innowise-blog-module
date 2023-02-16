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
    private $postRepositoryInterface;
    private $requestInterface;
    public function __construct(
        PostRepositoryInterface $postRepositoryInterface,
        RequestInterface $requestInterface,
        private UrlInterface $url
    ) {
        $this->postRepositoryInterface = $postRepositoryInterface;
        $this->requestInterface = $requestInterface;
    }

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
