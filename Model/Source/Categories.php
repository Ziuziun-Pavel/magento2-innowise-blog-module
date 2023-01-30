<?php

namespace Innowise\Blog\Model\Source;

use Innowise\Blog\Model\ResourceModel\Category\CollectionFactory;

class Categories implements \Magento\Framework\Option\ArrayInterface
{
    protected CollectionFactory $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $attributes = $this->getAttributes();
        return  $attributes;
    }

    private function getAttributes() {
        $collection = $this->collectionFactory->create();
        $attr_groups = [];
        foreach ($collection as $item) {
            $attr_groups[] = ['value' => $item->getData()['category_id'], 'label' => $item->getData()['category_id']];
        }

        return $attr_groups;
    }
}
