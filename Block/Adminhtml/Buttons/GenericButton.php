<?php

declare(strict_types=1);

namespace Innowise\Blog\Block\Adminhtml\Buttons;

use Innowise\Blog\Api\Data\CategoryInterface;
use Innowise\Blog\Api\Data\PostInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;

class GenericButton
{
    /**
     * @var UrlInterface
     */
    protected UrlInterface $urlBuilder;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    public function __construct(
        Context $context
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->request = $context->getRequest();
    }

    public function getUrl($route = '', $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    public function getPostId(): int
    {
        return (int)$this->request->getParam(PostInterface::POST_ID);
    }

    public function getCategoryId(): int
    {
        return (int)$this->request->getParam(CategoryInterface::CATEGORY_ID);
    }
}
