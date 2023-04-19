<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $users = User::all()->sortBy('name');

        return view('welcome', compact('users'));
    }
}
