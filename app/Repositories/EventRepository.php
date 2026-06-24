<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EventRepository
{

    private function query(): Builder
    {
        return Event::query()->where('active', true);
    }

    public function getAll(): Collection
    {
        return $this->query()->get();
    }

    public function findById(int $id): ?Event
    {
        return $this->query()->find($id);
    }

    public function findByUserId(int $userId): ?Event
    {
        return $this->query()
            ->where('user_id', $userId)
            ->get();
    }

    public function create(array $data): Event
    {
        return Event::create($data);
    }

    public function update(Event $model, array $data): Event
    {
        $model->fill($data);
        $model->save();

        return $model;
    }

    public function delete(int $id): bool
    {
        $event = $this->query()->find($id);

        if (!$event) {
            return false;
        }

        $event->active = false;
        $event->save();

        return true;
    }
}
