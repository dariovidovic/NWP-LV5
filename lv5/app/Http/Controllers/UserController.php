<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /*-----Kada admin klikne na Role settings prikazuju mu se osnovne informacije svih korisnika stranice-----*/
    public function showUsers(){
        $users = User::all();

        return view('admin', ['users'=> $users]);
    }

    /*-----Kada admin klikne na edit nekog korisnika, otvara mu se sucelje tog korisnika na kojemu moze editat role-----*/
    public function editUser($userId){
        $user = User::find($userId);

        return view('edit_user_role', ['user' => $user]);
    }

    /*-----Na dropdown menu, admin moze promijeniti ulogu korisnika-----*/
    public function updateUserRole(Request $request, $userId){

        $user = User::find($userId);
        $user->role = $request->input('role');
        $user->save();
        return redirect()->back()->with('success', 'User role updated successfully!');
    }
}
