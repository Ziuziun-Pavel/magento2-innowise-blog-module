<?php

declare(strict_types=1);

namespace Innowise\Blog\ViewModel;

use Innowise\Blog\Block\Html\CustomPager;
use Innowise\Blog\Service\PostsProvider;
use Innowise\Blog\Model\Post;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\View\Element\Template;

class Posts implements ArgumentInterface
{
    public function __construct(
        private PostsProvider $postsProvider,
        private RequestInterface $request
    )
    { }

    public function getPosts(int $limit): \Innowise\Blog\Api\Data\PostSearchResultsInterface|\Magento\Framework\Api\SearchResults
    {
        return $this->postsProvider->getPosts($limit, $this->getCurrentPage());
    }

    private function getCurrentPage(): int
    {
        return (int) $this->request->getParam('p');
    }

    public function getPager($collection, CustomPager $pagerBlock): string
    {
        $pagerBlock->setUseContainer(false)
            ->setShowPerPage(false)
            ->setShowAmount(false)
            ->setFrameLength(3)
            ->setLimit($collection->getTotalCount())
            ->setCollection($collection);

        return $pagerBlock->toHtml();
    }

    public function getPostHtml(Template $block, Post $post): string
    {
        $block->setData('post', $post);
        return $block->toHtml();
    }
}
