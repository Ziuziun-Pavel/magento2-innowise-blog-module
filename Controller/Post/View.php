<?php
declare(strict_types=1);

namespace Innowise\Blog\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Url;

class View implements HttpGetActionInterface
{
    protected $pageFactory;

    public function __construct(
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        private RequestInterface $request
    )
    {
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        var_dump($this->request->setPathInfo());
        var_dump($this->request->getParam('post_id'));

        return $this->pageFactory->create();
    }
}
