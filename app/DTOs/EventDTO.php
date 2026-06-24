<?php

namespace App\DTOs;

use App\Models\Event;
use Carbon\Carbon;

class EventDTO
{
    public function __construct(
        public string  $name,
        public string  $description,
        public string  $type,
        public string  $location,
        public Carbon  $start_at,
        public Carbon  $end_at,
        public bool    $active = true,
        public ?int    $user_id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'],
            type: $data['type'],
            location: $data['location'],
            start_at: Carbon::parse($data['start_at']),
            end_at: Carbon::parse($data['end_at']),
            active: $data['active'] ?? true,
            user_id: $data['user_id'] ?? null,
        );
    }

    public static function fromModel(Event $event): self
    {
        return new self(
            name: $event->name,
            description: $event->description,
            type: $event->type,
            location: $event->location,
            start_at: Carbon::parse($event->start_at),
            end_at: Carbon::parse($event->end_at),
            active: $event->active,
            user_id: $event->user_id,
        );
    }
}
