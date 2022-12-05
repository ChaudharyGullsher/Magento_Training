<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Console\Command;

use Magento\Framework\MessageQueue\PublisherInterface;
use Psr\Log\LoggerInterface;
use RLTSquare\Ccq\Api\Data\QueueMessageInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command line file that accept value from console and set to queue message via var1 & var2
 */
class Cli extends Command
{
    /**
     * variables var1 & var2 for getting input and send to queue message
     */
    const Var1 = 'var1';
    const Var2 = 'var2';
    /**
     * @var PublisherInterface
     */
    protected PublisherInterface $publisher;
    /**
     * @var QueueMessageInterface
     */
    protected QueueMessageInterface $queueData;
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     * @param QueueMessageInterface $queueData
     * @param PublisherInterface $publisher
     * @param string|null $name
     */
    public function __construct(
        LoggerInterface       $logger,
        QueueMessageInterface $queueData,
        PublisherInterface    $publisher,
        string                $name = null,
    ) {
        $this->publisher = $publisher;
        $this->queueData = $queueData;
        $this->logger = $logger;
        parent::__construct($name);
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('rltsquare:hello:world');
        $this->setDescription('Command Line cron for adding a message into a queue');
        $this->addArgument(
            self::Var1,
            null,
            InputArgument::IS_ARRAY,
            'Var1'
        );
        $this->addArgument(
            self::Var2,
            null,
            InputArgument::IS_ARRAY,
            'Var2'
        );
        parent::configure();
    }

    /**
     * Execute the command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;
        $var1 = $input->getArgument(self::Var1);
        $var2 = $input->getArgument(self::Var2);
        $this->queueData->setData(".$var1.$var2");
        $this->publisher->publish('cron.queue.message', $this->queueData->getData());
        $this->logger->info($var1 . $var2 . 'has been scheduled');
        return $exitCode;
    }
}
