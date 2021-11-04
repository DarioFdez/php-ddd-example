<?php

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Domain\NoVideoFound;
use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

class VideoLastFinderUseCase
{

    public function __construct(private VideoRepository $repository)
    {
    }

    public function execute(): ?Video
    {
        $video = $this->repository->searchLastVideo();

        if (null === $video) {
            throw new NoVideoFound();
        }

        return $video;
    }
}