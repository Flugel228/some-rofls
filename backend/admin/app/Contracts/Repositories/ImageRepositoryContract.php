<?php

namespace App\Contracts\Repositories;

use App\Models\Image;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

    public function update(
        int $id,
        array $data,
    ): bool;

    public function findById(int $id): Image|null;
}
