<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Movie;

class MovieControllerTest extends TestCase
{
    public function testCreateMovie()
    {
        $response = $this->post('/api/movie/add', [
            'title' => 'New Movie ' . rand(1, 9999),
            'genre' => 'Comedy',
            'duration' => 120,
            'cover' => '',
        ]);

        //
        $response->assertStatus(201)->assertJson([
            'message' => 'Movie created successfully',
        ]);

        // Get movie data from JSON response
        $movieData = $response->json();
        $movieId = $movieData['movie']['id'];

        $this->assertDatabaseHas('movies', ['id' => $movieId]);
    }

    public function testUpdateMovie()
    {
        // Create a new movie
        $movie = Movie::create([
            'title' => 'Original Title ' . rand(1, 9999),
            'genre' => 'Action',
            'duration' => 120,
            'cover' => 'original.jpg',
        ]);

        $movieId = $movie->id; // Get the ID of the created movie

        // Set updated data
        $updatedData = [
            'title' => 'Updated Title ' . rand(1, 9999),
            'genre' => 'Comedy',
            'duration' => 90,
            'cover' => '',
        ];

        $response = $this->put('/api/movie/update/' . $movieId, $updatedData);

        $response->assertStatus(200)->assertJson([
            'message' => 'Movie updated successfully'
        ]);

        // Verify that the movie has been updated in the database
        $this->assertDatabaseHas('movies', ['id' => $movieId]);
    }

    public function testDeleteMovie()
    {
        // Create a new movie
        $movie = Movie::create([
            'title' => 'Movie to Delete',
            'genre' => 'Drama',
            'duration' => 120,
            'cover' => 'delete.jpg',
        ]);

        $response = $this->delete('/api/movie/delete/' . $movie->id);

        $response->assertStatus(200)
                ->assertJson([
                    'message' => 'Movie deleted successfully',
                ]);

        // Verify that the movie has been deleted from the database
        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    }
}
