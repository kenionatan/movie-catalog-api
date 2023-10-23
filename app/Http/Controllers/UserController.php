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
     * 
     * @OA\PathItem(
     *     path="/api/user/get",
     * )
     * 
     * @OA\Get(
     *     path="/api/user/get",
     *     tags={"Users"},
     *     summary="Get a list of users",
     *     @OA\Response(
     *         response=200,
     *         description="A list of users",
     *     )
     * )
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
     * 
     * @OA\Post(
     *     path="/api/user/register",
     *     tags={"Users"},
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User registration data",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="John Doe"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 example="john@example.com"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string",
     *                 example="your-password"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="User registered successfully"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object"),
     *         )
     *     )
     * )
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