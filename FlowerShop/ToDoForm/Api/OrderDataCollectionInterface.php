<?php

declare(strict_types=1);

namespace FlowerShop\ToDoForm\Api;

use Magento\Sales\Api\Data\OrderInterface;
use FlowerShop\ToDoForm\Model\HeaderData;

interface OrderDataCollectionInterface
{
    public function collect(OrderInterface $order, HeaderData $headerData): array;
}
