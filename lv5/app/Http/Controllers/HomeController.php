<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*-----Nakon sto se korisnik prijavi, na main page-u se ispisuje njegova uloga tako da se dohvati iz baze podataka role i proslijedi view-u-----*/
    /*-----Default role je student, za admina sam rucno izmjenio u bazi jednog korisnika-----*/
    public function index()
    {
        $userRole = Auth::user()->role;
        return view('home', ['userRole' => $userRole]);
    }
}
