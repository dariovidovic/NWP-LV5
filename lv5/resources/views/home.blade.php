@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="card-body">
                    @if (Auth::check())
                        <p>Welcome, {{ Auth::user()->name }}!</p>
                        <p>Your role is: <b>{{ $userRole }}</b>!<p>
                    @else
                        <p>You are not logged in.</p>
                    @endif
                </div>
            </div>
            <div>
                @if (Auth::check() && Auth::user()->role == 'admin')
                        <a href="{{ route('admin') }}" class="btn btn-primary mt-2">Role settings</a>
                @endif
            </div>
            <div>
                @if (Auth::check() && Auth::user()->role == 'professor')
                        <a href="{{ route('locale.switch', app()->getLocale()) }}" class="btn btn-primary mt-2">Add thesis</a>
                        <a href="{{ route('tasks.myTasks') }}" class="btn btn-primary mt-2">My tasks</a>
                @endif
            </div>
            <div>
                @if (Auth::check() && Auth::user()->role == 'student')
                        <a href="{{ route('tasks.search') }}" class="btn btn-primary mt-2">Available projects</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
