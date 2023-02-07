<?php

namespace Innowise\Blog\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;

class View implements HttpGetActionInterface
{
    protected $pageFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
