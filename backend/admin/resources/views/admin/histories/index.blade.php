@extends('adminlte::page')
@section('content_header')
    <div class="row justify-content-between w-100">
        <h1 class="ml-2">Список ветвей истории</h1>
        <a class="btn btn-primary" href="{{ route('histories.create') }}">Добавить <i class="fa fa-plus"></i></a>
    </div>
@endsection
@section('content')
    @php
        $heads = [
            'ID',
            'Изображение',
            'Дата создания',
            ['label' => 'Действия', 'no-export' => true, 'width' => 5],
        ];
    @endphp
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark">
        @foreach($histories as $history)
            <tr>
                <td>{{ $history->id }}</td>
                <td><img src="{{ $history->image->url }}" alt="{{ $history->image->id }}" style="max-width: 200px; max-height: 200px"></td>
                <td>{{ $history->created_at }}</td>
                <td class="d-flex flex-row align-items-center">
                    <a href="{{ route('histories.edit', compact('history')) }}"
                       class="btn btn-xs btn-default text-primary mx-1 shadow" title="Изменить">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <form  action="{{ route('histories.destroy', compact('history')) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Удалить">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('histories.show', compact('history')) }}"
                       class="btn btn-xs btn-default text-teal mx-1 shadow" title="Подробнее">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    {{ $histories->links() }}
@endsection
