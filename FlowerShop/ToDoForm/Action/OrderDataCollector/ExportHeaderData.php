<?php

declare(strict_types=1);

namespace FlowerShop\ToDoForm\Action\OrderDataCollector;

use Magento\Sales\Api\Data\OrderInterface;
use FlowerShop\ToDoForm\Api\OrderDataCollectionInterface;
use FlowerShop\ToDoForm\Model\HeaderData;

class ExportHeaderData implements OrderDataCollectionInterface
{

    public function collect(OrderInterface $order, HeaderData $headerData): array
    {
        $ship_date = $headerData->getShipDate();
        return [
            'merchant_notes' => $headerData->getMerchantNotes(),
            'shipping' => [
                'ship_on' => ($ship_date !== null) ? $ship_date->format('d/m/y') : '',
            ]
        ];
    }
}
