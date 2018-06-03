<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APITest extends TestCase
{
    /**
     * To test if the register endpoint for
     *
     * @return void
     */
    public function testUserCreation ()
    {
        $response = $this->json('POST', '/api/register', [
            'name' => 'Demo User',
            'email' => str_random(10) . '@demo.com',
            'password' => '12345',
        ]);

        // checked the response to see if the status code is 200 and if the returned structure matches what we expect.
        $response->assertStatus(200)->assertJsonStructure([
            'success' => ['token', 'name']
        ]);

//        $this->assertTrue(true);
    }


    /**
     * To test if the login endpoint works
     *
     * @return void
     */
    public function testUserLogin () {
        $response = $this->json('POST', '/api/login', [
            'email' => 'demo@demo.com',
            'password' => 'secret'
        ]);

        $response->assertStatus(200)->assertJsonStructure([
            'success' => ['token']
        ]);
    }

    /**
     * To test fetching categories
     *
     * @return void
     */
    public function testCategoryFetch () {
        $user = \App\User::find(1);

        $response = $this->actingAs($user, 'api')
            ->json('GET', '/api/category')
            ->assertStatus(200)->assertJsonStructure([
                // The above structure assertion is indicated by the * that the key can be any string.
                '*' => [
                    'id',
                    'name',
                    'created_at',
                    'updated_at',
                    'deleted_at'
                ]
            ]);
    }

    /**
     * To test adding a new category
     *
     * @return void
     */
    public function testCategoryCreation () {
        // This leaves out the middleware(s) registered to this endpoint.
        // Because the auth:api is a middleware registered to this endpoint,
        // it is left put and we can call without authentication. This is not a
        // recommended method but it’s good to know it exists.
        $this->withoutMiddleware();

        $response = $this->json('POST', '/api/category', [
            'name' => str_random(10),
        ]);

        $response->assertStatus(200)->assertJson([
            'status' => true,
            'message' => 'Category Created'
        ]);
    }

    /**
     * To test deleting a resource
     *
     * @return void
     */
    public function testCategoryDeletion () {
        $user = \App\User::find(1);

        $category = \App\Category::create(['name' => 'To be deleted']);

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', "/api/category/{$category->id}")
            ->assertStatus(200)->assertJson([
                'status' => true,
                'message' => 'Category Deleted'
            ]);
    }
}
