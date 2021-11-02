<?php

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\DomainError;

final class NoVideoFound extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'no_video_found';
    }

    protected function errorMessage(): string
    {
        return 'No video found';
    }
}