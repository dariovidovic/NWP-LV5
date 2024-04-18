<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\UserApplication;
use Auth;


class StudentController extends Controller
{
    /*-----Kada korisnik klikne na available projects prikazuju mu se svi dostupni radovi-----*/
    public function searchTasks(){
        $user = Auth::user();
        $assignedTask = Task::where('assignee', $user->id)->first();
        $tasks = [];

        /*-----Ako je student odabran od profesora za rad, prikazuje mu se informacije vezane uz njegov rad-----*/
        if ($assignedTask) {
            $tasks[] = $assignedTask;
        } else {
            $tasks = Task::all();
        }

        return view('tasks', ['tasks'=> $tasks, 'assignedTask' => $assignedTask]);
    }

    /*-----Kada korisnik se prijavi na projekt dodaje se record u tablicu UserApplication-----*/
    public function apply(Request $request){
        $userApplication = new UserApplication();

        $userId = auth()->user()->id;
      
        $existingApplication = UserApplication::where('student_id', $userId)->where('task_id', (int)$request->input('task_id'))->first();
        /*-----Ako korisnik klikne na prijavi na projekt na koji se vec prijavio, izbacuje mu error poruku-----*/
        if ($existingApplication) {
                return redirect()->back()->with('error', 'You have already applied for this task!');
        }                
                       
        $userApplication->student_id = $userId;
        $userApplication->task_id = (int)$request->input('task_id');

        $userApplication->save();

        return redirect()->back()->with('success', 'Applied to task successfully!');
    }
}
