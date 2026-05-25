@extends('adminlte::page')

@section('title', 'Valdymo skydelis')

@section('content_header')
    <h1>Valdymo skydelis</h1>
@stop

@section('content')

    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalTickets }}</h3>
                    <p>Viso bilietų</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <a href="{{ route('tickets.index') }}" class="small-box-footer">
                    Peržiūrėti <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $newTickets }}</h3>
                    <p>Nauji bilietai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <a href="{{ route('tickets.index', ['status' => 'new']) }}" class="small-box-footer">
                    Peržiūrėti <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $inProgressTickets }}</h3>
                    <p>Vykdomi bilietai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-spinner"></i>
                </div>
                <a href="{{ route('tickets.index', ['status' => 'in_progress']) }}" class="small-box-footer">
                    Peržiūrėti <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $resolvedTickets }}</h3>
                    <p>Užbaigti bilietai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('tickets.index', ['status' => 'resolved']) }}" class="small-box-footer">
                    Peržiūrėti <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $closedTickets }}</h3>
                    <p>Uždaryti bilietai</p>
                </div>
                <div class="icon">
                    <i class="fas fa-lock"></i>
                </div>
                <a href="{{ route('tickets.index', ['status' => 'closed']) }}" class="small-box-footer">
                    Peržiūrėti <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-clock"></i> Naujausi bilietai
            </h3>
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
                    <th>Veiksmas</th>
                </tr>
                </thead>

                <tbody>
                @forelse($latestTickets as $ticket)
                    <tr>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->category->name }}</td>
                        <td>{{ $ticket->user->name }}</td>
                        <td>
                            @if($ticket->status === 'new')
                                <span class="badge badge-primary">Naujas</span>
                            @elseif($ticket->status === 'in_progress')
                                <span class="badge badge-warning">Vykdomas</span>
                            @elseif($ticket->status === 'resolved')
                                <span class="badge badge-success">Užbaigtas</span>
                            @else
                                <span class="badge badge-secondary">Uždarytas</span>
                            @endif
                        </td>
                        <td>{{ $ticket->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info">
                                Peržiūrėti
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Bilietų dar nėra.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>

    </div>

@stop