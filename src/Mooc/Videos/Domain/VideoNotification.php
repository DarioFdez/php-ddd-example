<?php

namespace CodelyTv\Mooc\Videos\Domain;

interface VideoNotification
{
    public function sendNotification(string $messageToSend): void;
}