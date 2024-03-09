<?php

namespace App\Repositories;

use App\Contracts\Repositories\ImageRepositoryContract;
use App\Models\Image;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ImageRepository extends CoreRepository implements ImageRepositoryContract
{

    protected function getModelClass(): string
    {
        return Image::class;
    }

    public function paginate(int $quantity, int $page): LengthAwarePaginator
    {
        return $this->startConditions()
            ->paginate(
                $quantity,
                ['id', 'url', 'created_at'],
                'page',
                $page
            );
    }

    public function create(array $data): Image
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

    public function findById(int $id): Image|null
    {
        return $this->startConditions()
            ?->find($id);
    }
}
