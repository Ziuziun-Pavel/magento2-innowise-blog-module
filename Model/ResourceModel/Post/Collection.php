<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\ResourceModel\Post;

use Innowise\Blog\Model\Post as Model;
use Innowise\Blog\Model\ResourceModel\Post\Post as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

abstract class Collection extends AbstractCollection
{

    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);


    }

    protected function _afterLoad()
    {
        $select= $this->getSelect();
        $select->joinLeft(
            ['secondTable' => $this->getTable('innowise_blog_post_category')],
            'main_table.post_id = secondTable.post_id',
            array('*')
        )->joinLeft(
            ['thirdTable' => $this->getTable('innowise_blog_category')],
            'secondTable.category_id = thirdTable.category_id',
            array('*')
        );


        foreach ($this as $item) {

            $categories = $this->getData('category_ids');

            $item->setData('category_ids', $categories);
        }

        return parent::_afterLoad();
    }

}
