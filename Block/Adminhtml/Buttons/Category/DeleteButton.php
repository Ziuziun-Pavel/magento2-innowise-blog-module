<?php

declare(strict_types=1);

namespace Innowise\Blog\Block\Adminhtml\Buttons\Category;

use Innowise\Blog\Api\Data\CategoryInterface;
use Innowise\Blog\Block\Adminhtml\Buttons\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getCategoryId()) {
            $data = [
                'label' => __('Delete Category'),
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
        return $this->getUrl('*/category/delete', [CategoryInterface::CATEGORY_ID => $this->getCategoryId()]);
    }
}
