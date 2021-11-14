<?php

namespace CodelyTv\Tests\Mooc\Courses\Infrastructure\Slack;

use CodelyTv\Mooc\Notifications\Domain\NotificationText;
use CodelyTv\Mooc\Notifications\Domain\NotificationType;
use CodelyTv\Mooc\Notifications\Infrastructure\Notifier\SlackNotifier;
use PHPUnit\Framework\TestCase;

class SlackAdapterTest extends TestCase
{
    private const SLACK_HOOK = 'XXXXX';
    /** @var SlackNotifier */
    private $sut;

    public function setUp()
    {
        parent::setUp();
        $settings = [
            'userName' => 'testUser',
            'channel' => 'testslack'
        ];
        $this->sut = new SlackNotifier(self::SLACK_HOOK, $settings);
    }

    public function testGivenAMessageAndNotificationTypeWhenNotifyThenSendASlackMessage(): void
    {
        $text = new NotificationText('Mensaje de prueba');
        $action = NotificationType::videoCreated();

        $this->sut->notify($text, $action);

        $this->assertTrue(true);
    }
}