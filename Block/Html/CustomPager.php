<?php
namespace Innowise\Blog\Block\Html;

use Magento\Framework\View\Element\Template\Context;
use Magento\Theme\Block\Html\Pager;

class CustomPager extends Pager
{
    /**
     * @var \Innowise\Blog\Api\Data\PostSearchResultsInterface
     */
    protected $collection;

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Set the collection for the pager.
     *
     * @param \Innowise\Blog\Api\Data\PostSearchResultsInterface $collection
     * @return $this
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Get the collection for the pager.
     *
     * @return \Innowise\Blog\Api\Data\PostSearchResultsInterface
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Override the toHtml method to use a custom template.
     *
     * @return string
     */
    public function toHtml()
    {
        $this->setTemplate('Innowise_Blog::custom_pager.phtml');
        return parent::toHtml();
    }

    /**
     * Get last page number
     *
     * @return int
     */
    public function getLastPageNum()
    {
        $pageSize = count($this->getCollection()->getItems());
        $totalCount = $this->getCollection()->getTotalCount();

        return ceil($totalCount / $pageSize);
    }

}
