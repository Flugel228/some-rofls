@extends('adminlte::page')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Добавить ветвь истории</h1>
@endsection
@section('content')
    <form action="{{ route('histories.store') }}" method="post">
        @csrf
        <div class="col">
            <div class="row">
                <x-adminlte-select2 name="type" label="Тип"
                                    fgroup-class="col-md-2"
                >
                    @foreach($types as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </x-adminlte-select2>
            </div>
            <div class="row">
                @error('type')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="row">
                <x-adminlte-select2 name="image_id" label="Слайд"
                                    fgroup-class="col-md-2"
                >
                    @foreach($images as $image)
                        <option value="{{ $image->id }}">{{ $image->id }}
                        </option>
                    @endforeach
                </x-adminlte-select2>
            </div>
            <div class="row">
                @error('type')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="row">
                <x-adminlte-select2 name="prev_history" label="Прошлая ветвь(если старт, то ничего не ставь, ибо мне лень реализовывать логику)"
                                    fgroup-class="col-md-2"
                >
                    <option value="0">-</option>
                    @foreach($histories as $history)
                        <option value="{{ $history->id }}">{{ $history->id }}
                        </option>
                    @endforeach
                </x-adminlte-select2>
            </div>
            <div class="row">
                @error('prev_history')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button class="btn btn-primary my-2">Добавить <i class="fa fa-plus"></i></button>
    </form>

@endsection
