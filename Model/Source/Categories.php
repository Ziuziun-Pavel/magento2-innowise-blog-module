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
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                'value' => $label['category_id'],
                'label' => $label['title'],
            ];
        }

        return $result;
    }

    public function getOptions()
    {
        $data = $this->collectionFactory->create();
        return $data->getData();
    }
}
