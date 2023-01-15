<?php

declare(strict_types=1);

namespace FlowerShop\ToDoForm\Model;

use Magento\Framework\View\Page\Config\Reader\Head;
use Magento\TestFramework\Eav\Model\Attribute\DataProvider\DateTime;

class HeaderData
{
    /**
     * @var ?\DateTime
     */
    private ?\DateTime $shipDate;
    /**
     * @var string
     */
    private string $merchantNotes;

    /**
     * @return \DateTime|null
     */
    public function getShipDate(): ?\DateTime
    {
        return $this->shipDate;
    }

    public function setShipDate(?\DateTime $shipDate): HeaderData
    {
        $this->shipDate = $shipDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantNotes(): string
    {
        return (string) $this->merchantNotes;
    }

    public function setMerchantNotes(string $merchantNotes): HeaderData
    {
        $this->merchantNotes = $merchantNotes;
        return $this;
    }
}
