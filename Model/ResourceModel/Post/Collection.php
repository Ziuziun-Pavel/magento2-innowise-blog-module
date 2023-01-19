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
            array('innowise_blog_post_category'=>$this->getTable('innowise_blog_post_category')),
            'innowise_blog_post.post_id=innowise_blog_post_category.category_id',
            array('*')
        );

        $select->joinLeft(
            array('innowise_blog_category'=>$this->getTable('innowise_blog_category')),
            'innowise_blog_post.category_id=innowise_blog_category.category_id',
            array('*')
        );
        foreach ($this as $item) {

            $categories = $this->getData('category_ids');

            var_dump($categories);
            $item->setData('category_ids', $categories);
        }

        return parent::_afterLoad();
    }

}
