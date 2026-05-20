@extends('adminlte::page')

@section('title', 'Redaguoti kategoriją')

@section('content_header')
    <h1>Redaguoti kategoriją</h1>
@stop

@section('content')

    @include('partials.alerts')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i> Kategorijos redagavimas
            </h3>
        </div>

        <form method="POST" action="{{ route('categories.update', $category) }}">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">

                    <label for="name">Pavadinimas</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="form-control"
                        required
                    >

                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-primary">

                    <i class="fas fa-save"></i> Išsaugoti

                </button>

                <a href="{{ route('categories.index') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i> Atgal

                </a>

            </div>

        </form>

    </div>

@stop