<?php

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;

class VideoMotherObject
{
    private const VIDEO_TITLE = 'Video Random';
    private const VIDEO_URL = 'https://www.google.es';
    public static function random(): Video
    {
        return new Video(
            new VideoId(VideoId::random()),
            VideoType::random(),
            new VideoTitle(self::VIDEO_TITLE),
            new VideoUrl(self::VIDEO_URL),
            new CourseId(CourseId::random())
        );
    }
}