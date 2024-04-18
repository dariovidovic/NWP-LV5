@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My tasks</h1>
    <div class="row">
        @foreach($tasks as $task)
        <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Naziv rada: {{ $task->naziv_rada }}</h5>
                        <h5 class="card-title">Naziv rada (en): {{ $task->naziv_rada_en }}</h5>
                        <p class="card-text">Zadatak rada: {{ $task->zadatak_rada }}</p>
                        <p class="card-text">Tip studija: {{ $task->tip_studija }}</p>
                        <ul>
                            @if($task->assignee)
                            @php
                                $assignedUser = \App\Models\User::find($task->assignee);
                            @endphp
                                 <li>Dodani student: {{ $assignedUser ? $assignedUser->email : 'User not found' }}</li>
                            @else
                            <h6>Studenti:</h6>
                                @foreach($task->students as $student)
                                <div class="d-flex flex-row mt-2">
                                <li class="mt-2 me-2">{{ $student->student->name }}</li>
                                    <form method="POST" action="{{ route('tasks.choose.student', ['task_id' => $task->id, 'student_id' => $student->student->id]) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Choose</button>
                                    </form>
                                </div>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a href="/home" class="btn btn-primary mt-4">Back</a>
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