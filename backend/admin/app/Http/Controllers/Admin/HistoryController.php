<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\HistoryRepositoryContract;
use App\Contracts\Repositories\ImageRepositoryContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\History\StoreRequest;
use App\Http\Requests\Admin\History\UpdateRequest;
use App\Models\History;

class HistoryController extends Controller
{

    public function __construct(
        public readonly HistoryRepositoryContract $historyRepository,
        public readonly ImageRepositoryContract   $imageRepository,
    )
    {
    }

    /**
     * Display a listing of the histories.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $page = (int)request()->query('page', '1');
        $histories = $this->historyRepository->paginate(10, $page);
        return view('admin.histories.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $types = History::getTypes();
        $images = $this->imageRepository->all();
        $histories = $this->historyRepository->all();
        return view(
            'admin.histories.create',
            compact(
                'types',
                'images',
                'histories'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $history = $this->historyRepository->create($data);
        return redirect()->route('histories.show', compact('history'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if ($history = $this->historyRepository->findById($id)) {
            $types = History::getTypes();
            return view(
                'admin.histories.show',
                compact(
                    'history',
                    'types'
                )
            );
        }
        abort(404, 'Ветвь истории не найден!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        if ($history = $this->historyRepository->findById($id)) {
            $types = History::getTypes();
            $images = $this->imageRepository->all();
            $histories = $this->historyRepository->all();
            return view('admin.histories.edit',
                compact(
                    'history',
                    'types',
                    'images',
                    'histories'
                ),
            );
        }
        abort(404, 'Ветвь истории не найден!');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        if ($history = $this->historyRepository->findById($id)) {
            $data = $request->validated();
            $this->historyRepository->update($id, $data);
            return redirect()->route('histories.show', compact('history'));
        }
        abort(404, 'Ветвь истории не найден!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if ($this->historyRepository->findById($id)) {
            $this->historyRepository->delete($id);
            return redirect()->route('histories.index');
        }
        abort(404, 'Ветвь истории не найден!');
    }
}
