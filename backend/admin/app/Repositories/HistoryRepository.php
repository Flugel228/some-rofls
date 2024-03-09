<?php

namespace App\Repositories;

use App\Contracts\Repositories\HistoryRepositoryContract;
use App\Models\History;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class HistoryRepository extends CoreRepository implements HistoryRepositoryContract
{

    protected function getModelClass(): string
    {
        return History::class;
    }

    public function paginate(int $quantity, int $page): LengthAwarePaginator
    {
        return $this->startConditions()
            ->paginate(
                $quantity,
                ['*'],
                'page',
                $page
            );
    }

    public function create(array $data): History
    {
        return $this->startConditions()->create($data);
    }

    public function update(
        int $id,
        array $data,
    ): bool
    {
        return $this->startConditions()
            ?->find($id)
            ->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->startConditions()
            ?->find($id)
            ->delete();
    }

    public function findById(int $id): History|null
    {
        return $this->startConditions()
            ?->find($id);
    }

    public function all(): Collection
    {
        return $this->startConditions()
            ->select([
                'id',
            ])
            ->get();
    }

}
