<?php
declare(strict_types=1);

namespace Innowise\Blog\Controller;

use Innowise\Blog\Service\PostIdChecker;
use Innowise\Blog\Service\CategoryIdChecker;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Url;

class Router implements \Magento\Framework\App\RouterInterface
{
    public function __construct(
        private PostIdChecker $postIdChecker,
        private CategoryIdChecker $categoryIdChecker,
        private ActionFactory $actionFactory
    )
    { }

    public function match(RequestInterface $request)
    {
        $pathInfo = trim($request->getPathInfo(), '/');
        $parts = explode('/', $pathInfo);

        // Handle blog page
        if (empty($parts[0]) || $parts[0] !== 'blog') {
            return null;
        }

        // Handle category page
        if (!empty($parts[1]) && !(substr($request->getPathInfo(), -1) === '/')) {
            $categoryId = $this->categoryIdChecker->checkUrlKey($parts[1]);
            if ($categoryId) {
                $request->setModuleName('blog')
                    ->setControllerName('category')
                    ->setActionName('view')
                    ->setParam('category_id', $categoryId);

                // Remove 'blog' and category URL key from the path info
                $pathInfo = substr($pathInfo, strlen('blog') + strlen($parts[1]) + 2);
                $request->setAlias(Url::REWRITE_REQUEST_PATH_ALIAS, $pathInfo);
                $request->setPathInfo($pathInfo);

                return $this->actionFactory->create(Forward::class);
            }
        }

        // Handle post page
        if (!empty($parts[1]) && substr($request->getPathInfo(), -1) === '/') {
            $postId = $this->postIdChecker->checkUrlKey($parts[1]);
            if ($postId) {
                $request->setModuleName('blog')
                    ->setControllerName('post')
                    ->setActionName('view')
                    ->setParam('post_id', $postId);

                // Remove 'blog' and post URL key from the path info
                $pathInfo = substr($pathInfo, strlen('blog') + strlen($parts[1]) + 2);
                $request->setAlias(Url::REWRITE_REQUEST_PATH_ALIAS, $pathInfo);
                $request->setPathInfo($pathInfo);

                return $this->actionFactory->create(Forward::class);
            }
        }

        return null;
    }
}
