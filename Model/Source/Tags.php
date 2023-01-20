<?php

namespace Innowise\Blog\Model\Source;

use Innowise\Blog\Model\ResourceModel\Post\CollectionFactory;
class Tags implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Innowise\Blog\Model\ResourceModel\Post\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param CollectionFactory $countryCollectionFactory
     * @param array $options
     */
    public function __construct(
        CollectionFactory $countryCollectionFactory,
    )
    {
        $this->collectionFactory = $countryCollectionFactory;
    }

    /**
     * get options as key value pair
     *
     * @return array
     */
    public function toOptionArray()
    {
        $collection = $this->collectionFactory->create();
        $options = [];
        foreach ($collection->getData('tags') as $value => $val) {
            $options[] = [
                'value' => $value,
                'label' => $value
            ];
            return $options;
        }
    }
}
