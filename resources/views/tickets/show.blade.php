@extends('adminlte::page')

@section('title', 'Bilieto peržiūra')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Bilieto peržiūra</h1>

        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Grįžti į sąrašą
        </a>
    </div>
@stop

@section('content')

    @include('partials.alerts')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-ticket-alt"></i> {{ $ticket->title }}
            </h3>

            <div class="card-tools">
                @if($ticket->status === 'new')
                    <span class="badge badge-primary">Naujas</span>
                @elseif($ticket->status === 'in_progress')
                    <span class="badge badge-warning">Vykdomas</span>
                @elseif($ticket->status === 'resolved')
                    <span class="badge badge-success">Užbaigtas</span>
                @else
                    <span class="badge badge-secondary">Uždarytas</span>
                @endif
            </div>
        </div>

        <div class="card-body">
            <p>
                <strong>Kategorija:</strong>
                {{ $ticket->category->name }}
            </p>

            <p>
                <strong>Savininkas:</strong>
                {{ $ticket->user->name }}
            </p>

            <p>
                <strong>Sukurta:</strong>
                {{ $ticket->created_at->format('Y-m-d H:i') }}
            </p>

            <hr>

            <h5>Aprašymas</h5>

            <p style="white-space: pre-line;">
                {{ $ticket->description }}
            </p>
        </div>

        @if(auth()->user()->isAdmin() || auth()->id() === $ticket->user_id)
            <div class="card-footer">
                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Redaguoti
                </a>
            </div>
        @endif
    </div>

    @if(auth()->user()->canManageTickets())
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-sync-alt"></i> Keisti būseną
                </h3>
            </div>

            <form method="POST" action="{{ route('tickets.updateStatus', $ticket) }}">
                @csrf
                @method('PATCH')

                <div class="card-body">
                    <div class="form-group">
                        <label for="status">Būsena</label>

                        <select id="status" name="status" class="form-control">
                            @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" @selected($ticket->status === $key)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Atnaujinti būseną
                    </button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-comment"></i> Pridėti komentarą
                </h3>
            </div>

            <form method="POST" action="{{ route('tickets.comments.store', $ticket) }}">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="comment">Komentaras / pastaba</label>

                        <textarea
                            id="comment"
                            name="comment"
                            rows="4"
                            class="form-control"
                            placeholder="Įrašykite komentarą..."
                            required
                        >{{ old('comment') }}</textarea>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success">
                        <i class="fas fa-plus"></i> Pridėti komentarą
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-comments"></i> Komentarai
            </h3>
        </div>

        <div class="card-body">
            @forelse($ticket->comments as $comment)
                <div class="border-bottom mb-3 pb-3">
                    <p class="mb-1">
                        <strong>{{ $comment->user->name }}</strong>
                        <span class="text-muted">
                            | {{ $comment->created_at->format('Y-m-d H:i') }}
                        </span>
                    </p>

                    <p style="white-space: pre-line;">
                        {{ $comment->comment }}
                    </p>
                </div>
            @empty
                <p class="text-muted mb-0">Komentarų nėra.</p>
            @endforelse
        </div>
    </div>

@stop