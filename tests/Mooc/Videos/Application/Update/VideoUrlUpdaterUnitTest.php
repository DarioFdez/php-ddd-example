<?php

namespace CodelyTv\Tests\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Application\Update\VideoUrlUpdater;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoMotherObject;
use CodelyTv\Tests\Mooc\Videos\Domain\VideoUrlUpdatedDomainEventMotherObject;
use CodelyTv\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class VideoUrlUpdaterUnitTest extends UnitTestCase
{
    /** @var VideoRepository|mixed|MockObject */
    private mixed $videoRepository;

    private const NEW_URL = 'https://www.google.com';

    public function setUp(): void
    {
        parent::setUp();
        $this->videoRepository = self::createMock(VideoRepository::class);
    }

    public function testGivenAValidNewUrlWhenExecuteThenReturnNull(): void
    {
        $video = VideoMotherObject::random();
        $newUrl = new VideoUrl(self::NEW_URL);

        $videoRepository = self::createMock(VideoRepository::class);
        $videoRepository
            ->expects(self::once())
            ->method('search')
            ->willReturn($video);

        $domainEvent = VideoUrlUpdatedDomainEventMotherObject::fromVideoAndNewUrl($video, $newUrl);

        $this->eventBus()
            ->shouldReceive('publish')
            ->with($this->similarTo($domainEvent))
            ->andReturnNull();

        $sut = new VideoUrlUpdater($this->videoRepository, $this->eventBus());
        $sut($video->id(), $newUrl);

        $this->assertTrue(true);
    }
}