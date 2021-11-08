<?php

namespace CodelyTv\Mooc\Videos\Domain;

use CodelyTv\Shared\Domain\Bus\Event\DomainEvent;

class VideoUrlUpdatedDomainEvent extends DomainEvent
{
    public function __construct(
        string $id,
        private string $type,
        private string $title,
        private string $oldUrl,
        private string $newUrl,
        private string $courseId,
        string $eventId = null,
        string $occurredOn = null
    ) {
        parent::__construct($id, $eventId, $occurredOn);
    }

    public static function eventName(): string
    {
        return 'video.url.updated';
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): VideoUrlUpdatedDomainEvent {
        return new self(
            $aggregateId,
            $body['type'],
            $body['title'],
            $body['oldUrl'],
            $body['newUrl'],
            $body['course_id'],
            $eventId,
            $occurredOn
        );
    }

    public function toPrimitives(): array
    {
        return [
            'type'      => $this->type,
            'title'     => $this->title,
            'oldUrl'    => $this->oldUrl,
            'newUrl'    => $this->newUrl,
            'course_id' => $this->courseId,
        ];
    }
}