<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $title="List of users";
        $users = User::all(); // Fetch all users from the database
        return view('user.index', compact('users',"title")); // Pass users to the view named 'user'
    }
}
