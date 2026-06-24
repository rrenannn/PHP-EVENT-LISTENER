<?php

namespace App\Http\Controllers;

use App\DTOs\EventDTO;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function __construct(
        private EventService $service,
    ) {}

    public function index(): JsonResponse
    {
        $events = $this->service->getAllActiveEvents();

        return response()->json($events);
    }

    public function show(int $id): JsonResponse
    {
        $event = $this->service->getEventById($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        return response()->json($event);
    }

    public function store(StoreEventRequest $request): JsonResponse
    {
        $dto = EventDTO::fromArray($request->validated());
        $event = $this->service->createEvent($dto);

        return response()->json($event, 201);
    }

    public function update(UpdateEventRequest $request, int $id): JsonResponse
    {
        $event = $this->service->getEventById($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        $dto = EventDTO::fromArray($request->validated());
        $updated = $this->service->updateEvent($event, $dto);

        return response()->json($updated);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->service->deleteEvent($id);

        if (!$deleted) {
            return response()->json(['message' => 'Event not found.'], 404);
        }

        return response()->json(null, 204);
    }
}
