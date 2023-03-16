<?php

namespace Innowise\Blog\Model\Source;

use Innowise\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Option\ArrayInterface;

class Tags implements ArrayInterface
{
    protected $collectionFactory;

    /**
     * @var array|null
     */
    protected $options;

    /**
     * @var ResourceConnection
     */
    protected $resource;

    public function __construct(
        CollectionFactory $collectionFactory,
        ResourceConnection $resource
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->resource = $resource;
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
        $connection = $this->resource->getConnection();
        $tableName = $this->resource->getTableName('innowise_blog_tag');
        $postTagsTable = $this->resource->getTableName('innowise_blog_post_tags');
        $select = $connection->select()
            ->from(['t' => $tableName], ['tag_id', 'name'])
            ->joinLeft(['pt' => $postTagsTable], 'pt.tag_id = t.tag_id', [])
            ->group('t.tag_id')
            ->order('name', 'ASC');
        return $connection->fetchAll($select);
    }
}
