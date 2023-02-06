<?php

namespace Innowise\Blog\Model\Source;

use Innowise\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\Option\ArrayInterface;

class Tags implements ArrayInterface
{
    protected $collectionFactory;

    /**
     * @var array|null
     */
    protected $options;

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
                'value' => $label['tag_id'],
                'label' => $label['name'],
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
