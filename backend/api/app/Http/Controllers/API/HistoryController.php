<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\HistoryRequest;
use App\Http\Resources\HistoryResponse;
use App\Models\History;

class HistoryController extends Controller
{
    public function findById(HistoryRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $types = History::getTypes();
        if ($data['id'] === 0) {
            $history = HistoryResponse::make(History::where('prev_history', '=', $data['id'])->first());
        } else {
            $history = HistoryResponse::make(History::find($data['id']));
        }
        $nextHistoriesIds = History::select('id')
            ->where('prev_history', '=', $history->id)
            ->get();
        return response()->json(
            compact(
                'history',
                'types',
                'nextHistoriesIds',
            )
        );
    }
}
