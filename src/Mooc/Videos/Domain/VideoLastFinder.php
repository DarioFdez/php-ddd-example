<?php

namespace CodelyTv\Mooc\Videos\Domain;

final class VideoLastFinder
{
    public function __construct(private VideoRepository $repository)
    {
    }

    public function __invoke(): Video
    {
        $video = $this->repository->searchLastVideo();

        if (null === $video) {
            throw new NoVideoFound();
        }

        return $video;
    }
}