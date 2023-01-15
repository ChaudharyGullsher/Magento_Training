<?php
declare(strict_types=1);

namespace FlowerShop\ToDoForm\Console\Command;

use FlowerShop\ToDoForm\Action\CollectionOrderData;
use FlowerShop\ToDoForm\Model\HeaderData;
use FlowerShop\ToDoForm\Model\HeaderDataFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OrderExport extends Command
{
    const ARG_NAME_ORDER_ID = 'order-id';
    const OPT_NAME_SHIP_DATE = 'ship-date';
    const OPT_NAME_MERCHANT_NOTES = 'notes';
    /**
     * @var HeaderDataFactory $headerDataFactory
     */
    private HeaderDataFactory $headerDataFactory;
    private CollectionOrderData $collectionOrderData;

    public function __construct(
        HeaderDataFactory $headerDataFactory,
        CollectionOrderData $collectionOrderData,
        string $name = null
    ) {
        $this->headerDataFactory = $headerDataFactory;
        parent::__construct($name);
        $this->collectionOrderData = $collectionOrderData;
    }

    /**
     * @inheritdoc
     */
    public function configure()
    {
        $this->setName('Flower-Shop:run')
            ->setDescription('Place order for flower Bucket')
            ->addArgument(
                self::ARG_NAME_ORDER_ID,
                InputArgument::REQUIRED,
                "Order ID"
            )
            ->addOption(
                self::OPT_NAME_SHIP_DATE,
                'd',
                InputOption::VALUE_OPTIONAL,
                'Shipping date in format YYYY-MM-DD'
            )
            ->addOption(
                self::OPT_NAME_MERCHANT_NOTES,
                null,
                InputOption::VALUE_OPTIONAL,
                ''
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Text to show in command line');

        $order_id = (int)$input->hasArgument(self::ARG_NAME_ORDER_ID);
        $ship_date = $input->getOption(self::OPT_NAME_SHIP_DATE);
        $notes = $input->getOption(self::OPT_NAME_MERCHANT_NOTES);

        /**
         * @var HeaderData $headerData
         */
        $headerData = $this->headerDataFactory->create();

        if ($ship_date) {
            $headerData->setShipDate(new \DataTime($ship_date));
        }
        if ($notes) {
            $headerData->setMerchantNotes($notes);
        }

        $orderData = $this->collectionOrderData->execute($order_id, $headerData);

        //$output->writeln(print_r($headerData, true));
        //$output->writeln(__('Order = ' . $order_id));
        $output->writeln(print_r($orderData));
        return 0;
    }
}
