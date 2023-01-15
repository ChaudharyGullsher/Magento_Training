<?php

declare(strict_types=1);

namespace FlowerShop\ToDoForm\Action;

use Magento\Sales\Api\OrderRepositoryInterface;
use FlowerShop\ToDoForm\Api\OrderDataCollectionInterface;
use FlowerShop\ToDoForm\Model\HeaderData;

class CollectionOrderData
{
    /**
     * @var OrderRepositoryInterface $orderRepository
     */
    private OrderRepositoryInterface $orderRepository;
    /**
     * @var OrderDataCollectionInterface[]
     */
    private $collectors;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        array $collectors = []
    ) {
        $this->orderRepository = $orderRepository;
        $this->collectors = $collectors;
    }

    public function execute(int $order_id, HeaderData $headerData): array
    {
        $order = $this->orderRepository->get($order_id);
        $output = [];
        foreach ($this->collectors as $collector){
            $output = array_merge_recursive($output, $collector->collect($order, $headerData));
        }
        return $output;
    }
}
