@extends('adminlte::page')

@section('title', 'Profilis')

@section('content_header')
    <h1>Profilio nustatymai</h1>
@stop

@section('content')

    @include('partials.alerts')

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">
            Profilio informacija atnaujinta.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="alert alert-success">
            Slaptažodis sėkmingai pakeistas.
        </div>
    @endif

    @if (session('status') === 'user-deleted')
        <div class="alert alert-danger">
            Vartotojas pašalintas.
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-user"></i> Profilio informacija
            </h3>
        </div>

        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>

    </div>

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-lock"></i> Keisti slaptažodį
            </h3>
        </div>

        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>

    </div>

    <div class="card card-danger">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-trash"></i> Pašalinti paskyrą
            </h3>
        </div>

        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>

    </div>

@stop