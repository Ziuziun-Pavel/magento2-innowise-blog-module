<?php

declare(strict_types=1);

namespace Innowise\Blog\Model\Post\DataProvider;

use Innowise\Blog\Api\Data\PostInterface;
use Innowise\Blog\Controller\Adminhtml\AbstractPost;
use Innowise\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\Request\DataPersistorInterface;

class Form extends AbstractDataProvider
{
    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var DataPersistorInterface
     */
    private DataPersistorInterface $dataPersistor;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        PostCollectionFactory $collectionFactory,
        RequestInterface $request,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->request = $request;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData(): array
    {
        $formData = $this->dataPersistor->get(AbstractPost::DATA_PERSISTOR_KEY);
        if (!empty($formData)
            && is_array($formData)
        ) {
            $postId = $formData[PostInterface::POST_ID] ?? null;
            $this->dataPersistor->clear(AbstractPost::DATA_PERSISTOR_KEY);
            $postData = $formData;
        } else {
            $postId = $this->request->getParam($this->getRequestFieldName());
            $post = $this->getCollection()
                ->addFieldToFilter(PostInterface::POST_ID, $postId)
                ->getFirstItem();
            if (!$post) {
                $post = $this->collection->getNewEmptyItem();
            }
            $postData = $post->getData();
        }
        $data[$postId] = $postData;

        return $data;
    }
}
