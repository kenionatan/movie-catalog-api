<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    public function testGetUsers()
    {
        // Create some test users in the database
        Factory::factoryForModel(User::class, 3)->create();

        // Send a GET request
        $response = $this->get('/api/user/get');

        // Assert that the response has a 200 status code (OK)
        $response->assertStatus(200);

        // Assert that the response is JSON
        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email'
            ],
        ]);
    }

    public function testRegisterUser()
    {
        // Define the user data to be registered
        $userData = [
            'name' => 'John Doe',
            'email' => 'john' . rand(1,9999) . '@example.com',
            'password' => 'password123',
        ];

        // Send a POST request
        $response = $this->post('/api/user/register', $userData);

        // Assert that the response has a 201 status code (Created)
        $response->assertStatus(201);

        // Assert that the response contains the expected JSON structure
        $response->assertJson([
            'message' => 'User registered successfully',
            'user' => [
                'name' => $userData['name'],
                'email' => $userData['email']
            ],
        ]);
    }
}
