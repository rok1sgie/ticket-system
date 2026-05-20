@extends('adminlte::page')

@section('title', 'Bilietai')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Bilietai</h1>

        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Naujas bilietas
        </a>
    </div>
@stop

@section('content')

    @include('partials.alerts')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filtrai</h3>
        </div>

        <div class="card-body">
            <form method="GET">
                <div class="row">

                    <div class="col-md-4">
                        <label>Būsena</label>

                        <select name="status" class="form-control">
                            <option value="">Visos</option>

                            @foreach(\App\Models\Ticket::statuses() as $key => $label)
                                <option value="{{ $key }}" @selected(request('status') === $key)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Kategorija</label>

                        <select name="category_id" class="form-control">
                            <option value="">Visos</option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button class="btn btn-dark mr-2">
                            Filtruoti
                        </button>

                        <a href="{{ route('tickets.index') }}"
                           class="btn btn-secondary">
                            Valyti
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">

        <div class="card-header">
            <h3 class="card-title">Bilietų sąrašas</h3>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover">

                <thead>
                <tr>
                    <th>Pavadinimas</th>
                    <th>Kategorija</th>
                    <th>Savininkas</th>
                    <th>Būsena</th>
                    <th>Data</th>
                    <th>Veiksmai</th>
                </tr>
                </thead>

                <tbody>

                @forelse($tickets as $ticket)

                    <tr>

                        <td>{{ $ticket->title }}</td>

                        <td>{{ $ticket->category->name }}</td>

                        <td>{{ $ticket->user->name }}</td>

                        <td>

                            @if($ticket->status === 'new')
                                <span class="badge badge-primary">
                                    Naujas
                                </span>

                            @elseif($ticket->status === 'in_progress')

                                <span class="badge badge-warning">
                                    Vykdomas
                                </span>

                            @elseif($ticket->status === 'resolved')

                                <span class="badge badge-success">
                                    Užbaigtas
                                </span>

                            @else

                                <span class="badge badge-secondary">
                                    Uždarytas
                                </span>

                            @endif

                        </td>

                        <td>
                            {{ $ticket->created_at->format('Y-m-d H:i') }}
                        </td>

                        <td>

                            <a href="{{ route('tickets.show', $ticket) }}"
                               class="btn btn-sm btn-info">
                                Peržiūrėti
                            </a>

                            @if(auth()->user()->isAdmin()
                                || auth()->id() === $ticket->user_id)

                                <a href="{{ route('tickets.edit', $ticket) }}"
                                   class="btn btn-sm btn-warning">
                                    Redaguoti
                                </a>

                                <form method="POST"
                                      action="{{ route('tickets.destroy', $ticket) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('Ar tikrai pašalinti?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        Trinti
                                    </button>

                                </form>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Bilietų nėra.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">
                {{ $tickets->links() }}
            </div>

        </div>
    </div>

@stop