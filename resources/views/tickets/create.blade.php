@extends('adminlte::page')

@section('title', 'Naujas bilietas')

@section('content_header')
    <h1>Naujas bilietas</h1>
@stop

@section('content')

    @include('partials.alerts')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-plus-circle"></i> Pateikti naują problemą
            </h3>
        </div>

        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <div class="card-body">

                <div class="form-group">
                    <label for="title">Pavadinimas</label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        class="form-control"
                        placeholder="Pvz.: Neveikia internetas"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="category_id">Kategorija</label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="form-control"
                        required
                    >
                        <option value="">Pasirinkite kategoriją</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(old('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Aprašymas</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="6"
                        class="form-control"
                        placeholder="Detaliai aprašykite problemą..."
                        required
                    >{{ old('description') }}</textarea>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Sukurti
                </button>

                <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atgal
                </a>
            </div>
        </form>
    </div>

@stop