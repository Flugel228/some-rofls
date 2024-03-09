@extends('adminlte::page')
@section('content_header')
    <div class="row justify-content-between w-100">
        <h1 class="ml-2">Список изображений</h1>
        <a class="btn btn-primary" href="{{ route('images.create') }}">Добавить <i class="fa fa-plus"></i></a>
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
        @foreach($images as $image)
            <tr>
                <td>{{ $image->id }}</td>
                <td><img src="{{ $image->url }}" alt="{{ $image->_id }}" style="max-width: 200px; max-height: 200px"></td>
                <td>{{ $image->created_at }}</td>
                <td class="d-flex flex-row align-items-center">
                    <a href="{{ route('images.edit', compact('image')) }}"
                       class="btn btn-xs btn-default text-primary mx-1 shadow" title="Изменить">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <form  action="{{ route('images.destroy', compact('image')) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Удалить">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('images.show', compact('image')) }}"
                       class="btn btn-xs btn-default text-teal mx-1 shadow" title="Подробнее">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
    {{ $images->links() }}
@endsection
