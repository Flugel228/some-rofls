@extends('adminlte::page')
@section('plugins.BsCustomFileInput', true)
@section('content_header')
    <h1>Добавить слайд</h1>
@endsection
@section('content')
    <form action="{{ route('images.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col">
            <div class="row">
                <x-adminlte-input-file name="image" igroup-size="sm" placeholder="Выберите слайд"
                                       label="Слайд" fgroup-class="col-md-4" legend="Найти">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-lightblue">
                            <i class="fas fa-upload"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input-file>
            </div>
            <div class="row">
                @error('image')
                <p class="text-red col">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button class="btn btn-primary my-2">Добавить <i class="fa fa-plus"></i></button>
    </form>

@endsection
