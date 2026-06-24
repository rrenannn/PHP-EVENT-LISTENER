<?php

namespace App\Repositories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EventRepository
{

    private function tenantQuery(): Builder
    {
        return Event::query();
    }

    public function getAll(): Collection
    {
        return Event::all();
    }

    public function findById(int $id): ?Event
    {
        return Event::find($id);
    }

    public function create(array $data): Event
    {
        return Event::create($data);
    }

    public function update(Event $model, array $data): Event
    {
        $model->fill($data);
        $model->updated_at = now();
        $model->save();

        return $model;
    }

    public function delete(int $id): int
    {
        return $this->tenantQuery()
            ->where('id', $id)
            ->update(['active' => false]);
    }
}
