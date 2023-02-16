<?php
declare(strict_types=1);

namespace Innowise\Blog\Controller;

use Innowise\Blog\Service\PostIdChecker;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
class Router implements \Magento\Framework\App\RouterInterface
{
    public function __construct(
        private PostIdChecker $postIdChecker,
        private ActionFactory $actionFactory
    )
    { }

    public function match(RequestInterface $request)
    {
        $pathInfo = trim($request->getPathInfo(), '/');
        $parts = explode('/', $pathInfo);
        var_dump($pathInfo);

        if (!empty($parts[0]) && $parts[0] === 'blog' && !empty($parts[1])) {
           $urlKey = $parts[1];
        } else {
            return null;
        }

        $postId = $this->postIdChecker->checkUrlKey($urlKey);

        if (!$postId) {
            return null;
        }

        $request->setModuleName('blog')
            ->setControllerName('post')
            ->setActionName('view')
            ->setParam('post_id', $postId);

//        $request->setAlias(Url::REWRITE_REQUEST_PATH_ALIAS, $pathInfo);
        $request->setPathInfo($urlKey);

        return $this->actionFactory->create(Forward::class);
    }
}
