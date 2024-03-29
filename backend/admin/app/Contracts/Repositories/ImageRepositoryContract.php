<?php

namespace App\Contracts\Repositories;

use App\Models\Image;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ImageRepositoryContract
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
     * @return Image
     */
    public function create(array $data): Image;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(
        int $id,
        array $data,
    ): bool;

    public function delete(int $id): bool;

    /**
     * @param int $id
     * @return Image|null
     */
    public function findById(int $id): Image|null;

    /**
     * @return Collection
     */
    public function all(): Collection;
}
