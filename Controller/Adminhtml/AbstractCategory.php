<?php

declare(strict_types=1);

namespace Innowise\Blog\Controller\Adminhtml;

use Magento\Backend\App\Action;

abstract class AbstractCategory extends Action
{
    public const ADMIN_RESOURCE = 'Innowise_Blog::innowise_blog_category';
    public const DATA_PERSISTOR_KEY = 'innowise_blog_category';
}
