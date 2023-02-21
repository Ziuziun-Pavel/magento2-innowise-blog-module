<?php
namespace Innowise\Blog\Block\Html;

use Magento\Framework\View\Element\Template\Context;
use Magento\Theme\Block\Html\Pager;

class CustomPager extends Pager
{
    /**
     * @var \Innowise\Blog\Api\Data\PostSearchResultsInterface
     */
    protected $postSearchResults;

    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function setPostSearchResults($postSearchResults)
    {
        $this->postSearchResults = $postSearchResults;
        return $this;
    }

    public function getPostSearchResults()
    {
        return $this->postSearchResults;
    }

    /**
     * Set the collection for the pager.
     *
     * @param \Innowise\Blog\Api\Data\PostSearchResultsInterface $postSearchResults
     * @return $this
     */
    public function setCollection($postSearchResults)
    {
        return $this->setPostSearchResults($postSearchResults);
    }

    /**
     * Get the collection for the pager.
     *
     * @return \Innowise\Blog\Api\Data\PostSearchResultsInterface
     */
    public function getCollection()
    {
        return $this->getPostSearchResults();
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
