<?php

declare(strict_types=1);

namespace Innowise\Blog\ViewModel;

use Innowise\Blog\Api\PostRepositoryInterface;
use Innowise\Blog\Model\ResourceModel\Post\Collection;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Innowise\Blog\Model\Post;

class PostViewModel implements ArgumentInterface
{
    private $collection;
    private $postRepositoryInterface;
    private $requestInterface;
    public function __construct(
        Collection $collection,
        PostRepositoryInterface $postRepositoryInterface,
        RequestInterface $requestInterface,
    ) {
        $this->collection = $collection;
        $this->postRepositoryInterface = $postRepositoryInterface;
        $this->requestInterface = $requestInterface;
    }

    public function getDetail()
    {
        $id = (int) $this->requestInterface->getParam('post_id');

        return $this->postRepositoryInterface->getById($id);
    }
}
