<?php

namespace Innowise\Blog\Model\Source;

use Innowise\Blog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Categories implements \Magento\Framework\Option\ArrayInterface
{
    public function __construct(
        CollectionFactory $collectionFactory,
        \Magento\Framework\ObjectManagerInterface $objectManager
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_objectManager = $objectManager;
    }


    public function toOptionArray()
    {
        $attributes = $this->getAttributes();
        return  $attributes;
    }



    public function getAttributes() {
        $collection = $this->_collectionFactory->create();
        $attr_groups = array();
        foreach ($collection as $item) {
            $attr_groups[] = ['value' => $item->getData()['category_id'], 'label' => $item->getData()['category_id']];
        }

        return $attr_groups;
    }

}
