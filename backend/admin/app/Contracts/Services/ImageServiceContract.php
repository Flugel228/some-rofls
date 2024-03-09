<?php

namespace App\Contracts\Services;

use App\Models\Image;

interface ImageServiceContract
{
    /**
     * @param array $data
     * @return Image
     */
    public function create(array $data): Image;

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(
        int $id,
        array $data
    ): void;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;
}
