<?php

declare(strict_types=1);

namespace RLTSquare\Ccq\Model\Queue;

use Psr\Log\LoggerInterface;

class Logger
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
     * @return void
     */
    public function processMessage()
    {
        $this->logger->debug('Processed queue message...');
    }
}
