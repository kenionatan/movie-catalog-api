<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of all users
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Create a new movie.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user record
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        dispatch(new SendWelcomeEmail($user));

        // Return a JSON response indicating success
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
}