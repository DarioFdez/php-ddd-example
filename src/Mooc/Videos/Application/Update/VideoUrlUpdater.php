<?php

namespace CodelyTv\Mooc\Videos\Application\Update;

use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Mooc\Videos\Domain\VideoFinder;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;
use CodelyTv\Shared\Domain\Bus\Event\EventBus;

class VideoUrlUpdater
{
    private VideoFinder $finder;

    public function __construct(private VideoRepository $repository, private EventBus $bus)
    {
        $this->finder = new VideoFinder($repository);
    }

    public function __invoke(VideoId $id, VideoUrl $newUrl): void
    {
        $video = $this->finder->__invoke($id);

        $video->updateUrl($newUrl);

        $this->repository->save($video);

        $this->bus->publish(...$video->pullDomainEvents());
    }
}