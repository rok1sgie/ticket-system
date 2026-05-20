@extends('adminlte::page')

@section('title', 'Nauja kategorija')

@section('content_header')
    <h1>Nauja kategorija</h1>
@stop

@section('content')

    @include('partials.alerts')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-plus-circle"></i> Sukurti kategoriją
            </h3>
        </div>

        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="card-body">

                <div class="form-group">

                    <label for="name">Pavadinimas</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control"
                        placeholder="Pvz.: Tinklas"
                        required
                    >

                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-primary">

                    <i class="fas fa-save"></i> Sukurti

                </button>

                <a href="{{ route('categories.index') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i> Atgal

                </a>

            </div>

        </form>

    </div>

@stop