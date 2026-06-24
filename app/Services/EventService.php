<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Support\Collection;

class EventService
{
    public function __construct(
        private EventRepository $repo,
    ) {}

    public function getAllActiveEvents(): Collection
    {
        return $this->repo->getAll();
    }

    public function getEventById(int $id): ?Event
    {
        return $this->repo->findById($id);
    }

    public function getEventByUserId(int $userId): Event
    {
        return $this->repo->findByUserId($userId);
    }

    public function createEvent(EventDTO $request): Event
    {
        return $this->repo->create([
            'name'        => $request->name,
            'description' => $request->description,
            'type'        => $request->type,
            'location'    => $request->location,
            'start_at'    => $request->start_at,
            'end_at'      => $request->end_at,
            'active'      => $request->active,
        ]);
    }

    public function updateEvent(Event $event, EventDTO $request): Event
    {
        return $this->repo->update($event, [
            'name'        => $request->name,
            'description' => $request->description,
            'type'        => $request->type,
            'location'    => $request->location,
            'start_at'    => $request->start_at,
            'end_at'      => $request->end_at,
        ]);
    }

    public function deleteEvent(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
