@extends('adminlte::page')

@section('title', 'Kategorijos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Kategorijos</h1>

        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nauja kategorija
        </a>
    </div>
@stop

@section('content')

    @include('partials.alerts')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-list"></i> Kategorijų sąrašas
            </h3>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Bilietų kiekis</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>

                <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td>{{ $category->name }}</td>

                        <td>
                            <span class="badge badge-info">
                                {{ $category->tickets_count }}
                            </span>
                        </td>

                        <td>

                            <a href="{{ route('categories.edit', $category) }}"
                               class="btn btn-sm btn-warning">

                                <i class="fas fa-edit"></i> Redaguoti

                            </a>

                            <form method="POST"
                                  action="{{ route('categories.destroy', $category) }}"
                                  class="d-inline"
                                  onsubmit="return confirm('Ar tikrai pašalinti kategoriją?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">

                                    <i class="fas fa-trash"></i> Trinti

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Kategorijų nėra.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

@stop