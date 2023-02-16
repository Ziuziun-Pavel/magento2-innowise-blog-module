<?php
namespace Innowise\Blog\Block\Html;

use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Theme\Block\Html\Pager;
use Magento\Framework\Data\Collection;

class CustomPager extends Pager
{
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function setCollection($collection)
    {
        if ($collection instanceof \Innowise\Blog\Api\Data\PostSearchResultsInterface) {
            $this->_collection = $collection->getItems();
            $this->setTotalNum($collection->getTotalCount());
        } elseif ($collection instanceof \Magento\Framework\Api\SearchResults) {
            $this->_collection = $collection->getItems();
            $this->setTotalNum($collection->getTotalCount());
        } else {
            parent::setCollection($collection);
        }

        return $this;
    }

    protected function _prepareLayout()
    {
        $collection = $this->getCollection();
        if ($collection instanceof \Innowise\Blog\Api\Data\PostSearchResultsInterface) {
            $this->setCurrentPage($collection->getSearchCriteria()->getCurrentPage());
            $this->setTotalNum($collection->getTotalCount());
            $this->setPageSize($collection->getPageSize());
        } else {
            parent::_prepareLayout();
        }
    }

    public function getCollection($collection = null)
    {
        if ($collection !== null) {
            $this->_collection = $collection;
        }
        if ($this->_collection instanceof \Innowise\Blog\Api\Data\PostSearchResultsInterface) {
            $this->_collection = $this->_collection->getItems();
        }
        return parent::getCollection();
    }
}
