<?php

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Domain\Video;
use CodelyTv\Mooc\Videos\Domain\VideoLastFinder;
use CodelyTv\Mooc\Videos\Domain\VideoRepository;

class VideoLastFinderUseCase
{
    private VideoLastFinder $finder;

    public function __construct(VideoRepository $repository)
    {
        $this->finder = new VideoLastFinder($repository);
    }

    public function execute(): ?Video
    {
        return $this->finder->__invoke();
    }
}