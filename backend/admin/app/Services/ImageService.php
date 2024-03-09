<?php

namespace App\Services;

use App\Contracts\Repositories\ImageRepositoryContract;
use App\Contracts\Services\ImageServiceContract;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ImageService implements ImageServiceContract
{
    public function __construct(
        private readonly ImageRepositoryContract $imageRepository,
    )
    {
    }

    public function create(array $data): Image
    {
        $name = md5(Carbon::now() . '_' . $data['image']
                    ->getClientOriginalName()) . '.' . $data['image']
                ->getClientOriginalExtension();
        $path = Storage::disk('public')->putFileAs('images', $data['image'], $name);
        $data = [
            'path' => $path,
            'url' => url("/storage/$path")
        ];
        return $this->imageRepository->create($data);
    }

    public function update(int $id, array $data): void
    {
        $image = $this->imageRepository->findById($id);
        $name = md5(Carbon::now() . '_' . $data['image']
                    ->getClientOriginalName()) . '.' . $data['image']
                ->getClientOriginalExtension();
        Storage::disk('public')->delete($image->path);
        $path = Storage::disk('public')->putFileAs('images', $data['image'], $name);
        $data = [
            'path' => $path,
            'url' => url("/storage/$path")
        ];
        $this->imageRepository->update($id, $data);
    }

    public function destroy(int $id): void
    {
        $image = $this->imageRepository->findById($id);
        Storage::disk('public')->delete($image->path);
        $this->imageRepository->delete($id);
    }
}
