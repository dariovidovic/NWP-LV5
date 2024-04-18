@extends('layouts.app') 

@section('content')
    <div class="container">
        <h1>Users List</h1>
        <div class="row">
            @foreach ($users as $user)
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Name: {{ $user->name }}</h5>
                        <p class="card-text">E-mail: {{ $user->email }}</p>
                        <p class="card-text">Role: {{ $user->role }}</p>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a href="/home" class="btn btn-primary mt-4">Back</a>
    </div>
@endsection