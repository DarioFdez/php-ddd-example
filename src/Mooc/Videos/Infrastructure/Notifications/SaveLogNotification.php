<?php

namespace CodelyTv\Mooc\Videos\Infrastructure\Notifications;

use CodelyTv\Mooc\Videos\Domain\VideoNotification;
use Psr\Log\LoggerInterface;

class SaveLogNotification implements VideoNotification
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }
    
    public function sendNotification(string $messageToSend): void
    {
        $this->logger->info($messageToSend);
    }
}