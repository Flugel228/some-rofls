@extends('adminlte::page')
@section('content_header')
    <div class="row justify-content-between w-100">
        <h1 class="ml-2">Слайд {{ $image->id }}</h1>
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
            <td>{{ $image->id }}</td>
        </tr>
        <tr>
            <td>Обложка</td>
            <td><img src="{{ $image->url }}" alt="Обложка {{ $image->_id }}" style="max-width: 200px; max-height: 200px"></td>
        </tr>
        <tr>
            <td>Создан</td>
            <td>{{ $image->created_at }}</td>
        </tr>
    </x-adminlte-datatable>
@endsection
