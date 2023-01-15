<?php

declare(strict_types=1);

namespace FlowerShop\ToDoForm\Action;

use Magento\Sales\Api\Data\OrderInterface;

class getOrderExportItems
{
    /**
     * @var array
     */
    private array $allowedTypes;

    public function __construct(
        array $allowedTypes = []
    ) {
        $this->allowedTypes = $allowedTypes;
    }

    public function execute(OrderInterface $order): array
    {
        $items = [];
        foreach ($order->getItems() as $orderItem) {
            if (in_array($orderItem->getProductType(), $this->allowedTypes)) {
                $items[] = $orderItem;
            }
        }
        return $items;
    }
}
