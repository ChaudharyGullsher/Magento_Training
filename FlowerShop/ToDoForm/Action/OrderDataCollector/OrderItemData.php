<?php

declare(strict_types=1);

namespace FlowerShop\ToDoForm\Action\OrderDataCollector;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\Data\OrderItemInterface;
use FlowerShop\ToDoForm\Action\getOrderExportItems;
use FlowerShop\ToDoForm\Api\OrderDataCollectionInterface;
use FlowerShop\ToDoForm\Model\HeaderData;

class OrderItemData implements OrderDataCollectionInterface
{
    private getOrderExportItems $getOrderExportItems;

    public function __construct(
        getOrderExportItems $getOrderExportItems
    ){
        $this->getOrderExportItems = $getOrderExportItems;
    }

    public function collect(OrderInterface $order, HeaderData $headerData): array
    {
        $items = [];
        foreach ($this->getOrderExportItems->execute($order) as $orderItem) {
            $items[] = $this->transform($orderItem);
        }
        return [
            'items' => $items,
        ];
    }

    private function transform(OrderItemInterface $orderItem): array
    {
        return [
            'sku' => $orderItem->getSku(),
            'qty' => $orderItem->getQtyOrdered(),
            'item_price' => $orderItem->getBasePrice(),
            'item_cost' => $orderItem->getBaseCost(),
            'total' => $orderItem->getBaseRowTotal(),
        ];
    }
}
