<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of all the movies.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $movies = Movie::all();

        return response()->json($movies);
    }

    /**
     * Create a new movie.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'duration' => 'required|integer|min:0',
            'cover' => 'nullable|url',
        ]);

        // Create a new movie using the request data
        $movie = new Movie([
            'title' => $request->input('title'),
            'genre' => $request->input('genre'),
            'duration' => $request->input('duration'),
            'cover' => $request->input('cover'),
        ]);

        // Save the movie to the database
        $movie->save();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Movie created successfully', 'movie' => $movie], 201);
    }

    /**
     * Update the specified movie.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        // Find the movie by ID
        $movie = Movie::find($id);

        // Check if the movie exists
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        // Validate the request data
        $request->validate([
            'title' => 'string|max:255',
            'genre' => 'string|max:255',
            'duration' => 'integer|min:0',
            'cover' => 'nullable|url',
        ]);

        // Update the movie attributes
        if ($request->has('title')) {
            $movie->title = $request->input('title');
        }
        if ($request->has('genre')) {
            $movie->genre = $request->input('genre');
        }
        if ($request->has('duration')) {
            $movie->duration = $request->input('duration');
        }
        if ($request->has('cover')) {
            $movie->cover = $request->input('cover');
        }

        // Save the updated movie
        $movie->save();

        // Return a JSON response indicating success
        return response()->json(['message' => 'Movie updated successfully', 'movie' => $movie], 200);
    }

    /**
     * Delete the specified movie.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Find the movie by ID
        $movie = Movie::find($id);

        // Check if the movie exists
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        // Delete the movie
        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully'], 200);
    }
}