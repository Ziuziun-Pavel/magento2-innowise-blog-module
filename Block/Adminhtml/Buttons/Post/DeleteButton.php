<?php

declare(strict_types=1);

namespace Innowise\Blog\Block\Adminhtml\Buttons\Post;

use Innowise\Blog\Api\Data\PostInterface;
use Innowise\Blog\Block\Adminhtml\Buttons\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getPostId()) {
            $data = [
                'label' => __('Delete Post'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    private function getDeleteUrl(): string
    {
        return $this->getUrl('*/post/delete', [PostInterface::POST_ID => $this->getPostId()]);
    }
}
