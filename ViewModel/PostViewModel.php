<?php

declare(strict_types=1);

namespace Innowise\Blog\ViewModel;

use Innowise\Blog\Api\PostRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class PostViewModel implements ArgumentInterface
{
    private $postRepositoryInterface;
    private $requestInterface;
    public function __construct(
        PostRepositoryInterface $postRepositoryInterface,
        RequestInterface $requestInterface,
    ) {
        $this->postRepositoryInterface = $postRepositoryInterface;
        $this->requestInterface = $requestInterface;
    }

    public function getPost()
    {
        $url_key = (string) $this->requestInterface->getParam('url_key');

        return $this->postRepositoryInterface->getByUrlKey($url_key);
    }
}
