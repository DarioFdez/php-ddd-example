<?php

namespace CodelyTv\Tests\Mooc\Videos\Application;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Application\Find\VideoLastFinderUseCase;
use CodelyTv\Mooc\Videos\Domain\NoVideoFound;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;
use CodelyTv\Tests\Shared\Domain\UuidMother;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class VideoLastFinderUseCaseUnitTest extends TestCase
{
    /** @var VideoRepository|mixed|MockObject */
    private mixed $videoRepository;
    private VideoLastFinderUseCase $sut;

    private const VIDEO_TITLE = 'Titulo';
    private const VIDEO_URL = 'https://www.youtube.com';

    public function setUp(): void
    {
        parent::setUp();
        $this->videoRepository = $this->createMock(VideoRepository::class);
        $this->sut = new VideoLastFinderUseCase($this->videoRepository);
    }

    public function testReturnLastVideoWhenExecute(): void
    {
        $videoId = new VideoId(UuidMother::create());
        $videoType = VideoType::random();
        $videoTitle = new VideoTitle(self::VIDEO_TITLE);
        $videoUrl = new VideoUrl(self::VIDEO_URL);
        $courseId = CourseIdMother::create();
        $this->videoRepository
            ->expects(self::once())
            ->method('searchLastVideo')
            ->willReturn(
                new Video($videoId, $videoType, $videoTitle, $videoUrl, $courseId)
            );
        $result = $this->sut->execute();

        $this->assertSame($videoId, $result->id());
        $this->assertSame($videoType, $result->type());
        $this->assertSame($videoTitle, $result->title());
        $this->assertSame($videoUrl, $result->url());
        $this->assertSame($courseId, $result->courseId());
    }

    public function testReturnNullWhenExecute(): void
    {
        $this->videoRepository
            ->expects(self::once())
            ->method('searchLastVideo')
            ->willReturn(null);
        self::expectException(NoVideoFound::class);
        $this->sut->execute();
    }
}