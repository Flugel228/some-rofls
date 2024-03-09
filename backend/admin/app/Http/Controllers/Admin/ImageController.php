<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\ImageRepositoryContract;
use App\Contracts\Services\ImageServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\StoreRequest;
use App\Http\Requests\Admin\Image\UpdateRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public function __construct(
        public readonly ImageRepositoryContract $imageRepository,
        public readonly ImageServiceContract    $service,
    )
    {
    }

    /**
     * Display a listing of the images.
     */
    public function index(): \Illuminate\Contracts\View\Factory|
    \Illuminate\Foundation\Application|
    \Illuminate\Contracts\View\View|
    \Illuminate\Contracts\Foundation\Application
    {
        $page = (int)request()->query('page', '1');
        $images = $this->imageRepository->paginate(10, $page);
        return view('admin.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|
    \Illuminate\Foundation\Application|
    \Illuminate\Contracts\View\View|
    \Illuminate\Contracts\Foundation\Application
    {
        return view('admin.images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $image = $this->service->create($data);
        return redirect()->route('images.show', compact('image'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|
    \Illuminate\Foundation\Application|
    \Illuminate\Contracts\View\View|
    \Illuminate\Contracts\Foundation\Application
    {
        if ($image = $this->imageRepository->findById($id)) {
            return view('admin.images.show', compact('image'));
        }
        abort(404, 'Слайд не найден!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): \Illuminate\Contracts\View\Factory|
    \Illuminate\Foundation\Application|
    \Illuminate\Contracts\View\View|
    \Illuminate\Contracts\Foundation\Application
    {
        if ($image = $this->imageRepository->findById($id)) {
            return view('admin.images.edit', compact('image'));
        }
        abort(404, 'Слайд не найден!');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        if ($image = $this->imageRepository->findById($id)) {
            $data = $request->validated();
            $this->service->update($id, $data);
            return redirect()->route('images.show', compact('image'));
        }
        abort(404, 'Слайд не найден!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if ($this->imageRepository->findById($id)) {
            $this->service->destroy($id);
            return redirect()->route('images.index');
        }
        abort(404, 'Слайд не найден!');
    }
}
