<?php
namespace Innowise\Blog\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\UrlInterface;

class Router implements \Magento\Framework\App\RouterInterface
{
    protected $actionFactory;
    protected $eventManager;
    protected $url;

    public function __construct(ActionFactory $actionFactory, ManagerInterface $eventManager, UrlInterface $url)
    {
        $this->actionFactory = $actionFactory;
        $this->eventManager = $eventManager;
        $this->url = $url;
    }

    public function match(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');
        $parts = explode('/', $identifier);

        var_dump($parts);

        if (count($parts) == 1 && $parts[0] == 'blog') {
            $request->setModuleName('Innowise_Blog')
                ->setControllerName('index')
                ->setActionName('index');
            return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class);
        }

        if (count($parts) == 2 && $parts[0] == 'blog') {
            $request->setModuleName('Innowise_Blog')
                ->setControllerName('post')
                ->setActionName('view')
                ->setParam('url_key', $parts[1]);
            return $this->actionFactory->create(\Magento\Framework\App\Action\Forward::class);
        }

        return null;
    }
}
