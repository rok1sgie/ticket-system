@extends('adminlte::page')

@section('title', 'Redaguoti bilietą')

@section('content_header')
    <h1>Redaguoti bilietą</h1>
@stop

@section('content')

    @include('partials.alerts')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i> Bilieto redagavimas
            </h3>
        </div>

        <form method="POST" action="{{ route('tickets.update', $ticket) }}">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="form-group">
                    <label for="title">Pavadinimas</label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $ticket->title) }}"
                        class="form-control"
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
                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                @selected(old('category_id', $ticket->category_id) == $category->id)>

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
                        required
                    >{{ old('description', $ticket->description) }}</textarea>
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Išsaugoti
                </button>

                <a href="{{ route('tickets.show', $ticket) }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i> Atgal

                </a>

            </div>

        </form>

    </div>

@stop