<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use App\Models\Task;
use App\Models\UserApplication;
use App\Models\User;
use Auth;


use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /*-----Kad se odlazi na add thesis stranicu, default locale je hr -> putanja je /thesis/hr-----*/
    public function addThesis(Request $request){
        /*-----Prvi segment URL-a je thesis, drugi oznacava locale koji se switcha na klik buttona-----*/
        $requestLocale = $request->segment(2);
        app()->setLocale($requestLocale);
        $currentLocale = app()->getLocale();

        /*-----U view se vraca locale kako bi se mogle povuci vrijednosti iz resources/lang en i hr subfoldera-----*/
        return view('add_thesis', ['locale' => $currentLocale]);
    }

    public function saveTask(Request $request){
        
        /*-----Validacija podataka, forma ne smije biti prazna prilikom pohrane-----*/
        $validatedData = $request->validate([
            'naziv_rada' => 'required|string',
            'naziv_rada_en' => 'required|string',
            'zadatak_rada' => 'required|string',
            'tip_studija' => 'required|in:preddiplomski,diplomski,strucni',
        ]);

        $professorId = Auth::id();

        /*-----Kreiranje novog taska, dodjela vrijednosti atributa objekta te pohrana u bazu-----*/
        $task = new Task();
        $task->naziv_rada = $validatedData['naziv_rada'];
        $task->naziv_rada_en = $validatedData['naziv_rada_en'];
        $task->zadatak_rada = $validatedData['zadatak_rada'];
        $task->tip_studija = $validatedData['tip_studija'];
        $task->nastavnik_id = $professorId;

        $task->save();

        return redirect()->back()->with('success', 'Task added successfully!');
    }

    public function myTasks(){
        /*-----Kada profesor klikne na my tasks prikazuju mu se samo njegovi radovi iz baze-----*/
        $tasks = Task::where('nastavnik_id', Auth::id())->get();

        /*-----Ispod svakog rada profesora, nalazi se popis studenata koji su se prijavili na rad (iz tablice UserApplication)-----*/
        foreach ($tasks as $task) {
            $task->students = UserApplication::where('task_id', $task->id)->with('student')->get();
        }

        return view('professor_tasks', ["tasks"=>$tasks]);
    }

    /*-----Kada profesor odabere jednog od studenata, u tablicu tasks dodaje se id studenta u "assignee column"-----*/
    public function chooseStudent($taskId, $studentId) {
        $task = Task::findOrFail($taskId); 
        $student = User::findOrFail($studentId); 
    
        $task->assignee = $studentId;
        /*-----Prilikom odabira, brisu se ostale prijave studenta tako da se ne prikazuju na ostalim radovima-----*/
         UserApplication::where('student_id', $studentId)
               ->where('task_id', '!=', $taskId)
               ->delete();
        $task->save();
    
        return redirect()->back()->with('success', 'Student assigned successfully!');
    }
}
