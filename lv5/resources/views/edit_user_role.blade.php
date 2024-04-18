@extends('layouts.app') 

@section('content')
    <div class="container">
        <h1>Edit User Role</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Name: {{ $user->name }}</h5>
                        <p class="card-text">E-mail: {{ $user->email }}</p>
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="role">Role:</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="professor" {{ $user->role == 'professor' ? 'selected' : '' }}>Professor</option>
                                    <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        <br>
        <a href="/admin" class="btn btn-primary">Back</a>
        @if(session('success'))
        <div class="alert alert-success w-25 d-flex justify-content-center mt-2">
            {{ session('success') }}
        </div>
        @endif
    </div>  
@endsection