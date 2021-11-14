<?php

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;
use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoTitle;
use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Mooc\Videos\Domain\VideoUrlUpdatedDomainEvent;
use CodelyTv\Tests\Mooc\Courses\Domain\CourseIdMother;

class VideoUrlUpdatedDomainEventMotherObject
{
    public static function create(
        ?VideoId $id = null,
        ?VideoType $type = null,
        ?VideoTitle $title = null,
        ?VideoUrl $oldUrl = null,
        ?VideoUrl $newUrl = null,
        ?CourseId $courseId = null
    ): VideoUrlUpdatedDomainEvent {
        return new VideoUrlUpdatedDomainEvent(
            $id->value() ?? VideoId::random(),
            $type->value() ?? VideoType::random(),
            $title->value() ?? new VideoTitle('Test Title'),
            $oldUrl->value() ?? new VideoUrl('https://www.google.es'),
            $newUrl->value() ?? new VideoUrl('https://www.google.com'),
            $courseId->value() ?? CourseIdMother::create()->value()
        );
    }

    public static function fromVideoAndNewUrl(Video $video, VideoUrl $newUrl): VideoUrlUpdatedDomainEvent
    {
        return self::create(
            $video->id(),
            $video->type(),
            $video->title(),
            $video->url(),
            $newUrl,
            $video->courseId()
        );
    }
}