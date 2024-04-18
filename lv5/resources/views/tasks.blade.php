@extends('layouts.app')

@section('content')
@if($assignedTask)
<div class="container w-25">
<h1>Assigned Task</h1>
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">Naziv rada: {{ $assignedTask->naziv_rada }}</h5>
                <p class="card-text">Naziv rada (en): {{ $assignedTask->zadatak_rada_en }}</p>
                <p class="card-text">Zadatak rada: {{ $assignedTask->zadatak_rada }}</p>
                <p class="card-text">Tip studija: {{ $assignedTask->tip_studija }}</p>
                <p class="card-text">Nastavnik: {{ $assignedTask->nastavnik->name }}</p>
            </div>
        </div>
        <a href="/home" class="btn btn-primary mt-4">Back</a>
</div>     
    @else
    <div class="container">
    <h1>Available tasks</h1>
        <div class="row">
            @foreach($tasks as $task)
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Naziv rada: {{ $task->naziv_rada }}</h5>
                        <p class="card-text">Naziv rada (en): {{ $task->zadatak_rada_en }}</p>
                        <p class="card-text">Zadatak rada: {{ $task->zadatak_rada }}</p>
                        <p class="card-text">Tip studija: {{ $task->tip_studija }}</p>
                        <p class="card-text">Nastavnik: {{ $task->nastavnik->name }}</p>
                        @if($task->assignee)
                            @php
                                $assignedUser = \App\Models\User::find($task->assignee);
                            @endphp
                                 <li>Dodani student: {{ $assignedUser ? $assignedUser->email : 'User not found' }}</li>
                        @else
                        <form method="POST" action="{{ route('tasks.apply') }}">
                            @csrf
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <button type="submit" class="btn btn-primary">Prijavi se</button>
                        </form>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a href="/home" class="btn btn-primary mt-4">Back</a>
    </div>
    @endif
        @if(session('success'))
            <div class="alert alert-success w-25 d-flex justify-content-center mt-2">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger w-25 d-flex justify-content-center mt-2">{{ session('error') }}</div>
        @endif
    </div>     
@endsection