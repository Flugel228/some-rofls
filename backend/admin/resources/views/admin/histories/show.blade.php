@extends('adminlte::page')
@section('content_header')
    <div class="row justify-content-between w-100">
        <h1 class="ml-2">Ветвь истории №{{ $history->id }}</h1>
    </div>
@endsection
@section('content')
    @php
        $heads = [
            'Атрибут',
            'Значие',
        ];
    @endphp
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        <tr>
            <td>id</td>
            <td>{{ $history->id }}</td>
        </tr>
        <tr>
            <td>Слайд</td>
            <td><img src="{{ $history->image->url }}" alt="Слайд {{ $history->_id }}" style="max-width: 200px; max-height: 200px"></td>
        </tr>
        <tr>
            <td>Тип</td>
            <td>
                @foreach($types as $key => $type)
                    {{ $history->type === $key ? $type : '' }}
                @endforeach
            </td>
        </tr>
        @if($history->type === \App\Models\History::TYPE_GAP || $history->type === \App\Models\History::TYPE_END)
            <tr>
                <td>Прошлая ветвь</td>
                <td>{{ $history->prev_history }}</td>
            </tr>
        @endif
        <tr>
            <td>Создан</td>
            <td>{{ $history->created_at }}</td>
        </tr>
    </x-adminlte-datatable>
@endsection
