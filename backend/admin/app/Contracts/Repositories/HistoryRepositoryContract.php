<?php

namespace App\Contracts\Repositories;

use App\Models\History;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface HistoryRepositoryContract
{
    /**
     * @param int $quantity
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginate(
        int $quantity,
        int $page
    ): LengthAwarePaginator;

    /**
     * @param array $data
     * @return History
     */
    public function create(array $data): History;

    public function update(
        int $id,
        array $data,
    ): bool;

    public function delete(int $id): bool;

    public function findById(int $id): History|null;

    /**
     * @return Collection
     */
    public function all(): Collection;
}
