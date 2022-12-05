<?php

namespace RLTSquare\Ccq\Cron;

use Psr\Log\LoggerInterface;

class QueueMessageCron
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     *
     * @return void
     */
    public function execute()
    {

        $this->logger->info('Hello Word Message from rltsquare_hello_world cron');
    }
}
