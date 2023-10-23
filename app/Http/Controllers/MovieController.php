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
     * 
     * @OA\Info(
     *     title="Movie Catalog API",
     *     version="1.0",
     *     description="Movie Catalog API",
     * )
     * 
     * @OA\PathItem(
     *     path="/api/movie/get",
     * )
     * 
     * @OA\Get(
     *     path="/api/movie/get",
     *     tags={"Movies"},
     *     summary="Get a list of movies",
     *     @OA\Response(
     *         response=200,
     *         description="A list of movies",
     *     )
     * )
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
     * 
     * @OA\PathItem(
     *     path="/api/movie/add",
     * )
     * 
     * @OA\Post(
     *     path="/api/movie/add",
     *     tags={"Movies"},
     *     summary="Create a new movie",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Movie data",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 example="Movie Title"
     *             ),
     *             @OA\Property(
     *                 property="genre",
     *                 type="string",
     *                 example="Action"
     *             ),
     *             @OA\Property(
     *                 property="duration",
     *                 type="integer",
     *                 example=120
     *             ),
     *             @OA\Property(
     *                 property="cover",
     *                 type="string",
     *                 example="https://example.com/movie.jpg"
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Movie Created",
     *     )
     * )
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
     * 
     * @OA\Put(
     *     path="/api/movie/update/{id}",
     *     tags={"Movies"},
     *     summary="Update a movie",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the movie to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Updated movie data",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 example="Updated Movie Title"
     *             ),
     *             @OA\Property(
     *                 property="genre",
     *                 type="string",
     *                 example="Updated Genre"
     *             ),
     *             @OA\Property(
     *                 property="duration",
     *                 type="integer",
     *                 example=130
     *             ),
     *             @OA\Property(
     *                 property="cover",
     *                 type="string",
     *                 example="https://example.com/updated-movie.jpg"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Movie Updated",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found",
     *     )
     * )
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
     * 
     * @OA\Delete(
     *     path="/api/movie/delete/{id}",
     *     tags={"Movies"},
     *     summary="Delete a movie",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the movie to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Movie Deleted",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Movie not found",
     *     )
     * )
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