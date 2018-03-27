<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Post;
use Carbon\Carbon;

class ExampleTest extends TestCase
{

    // To refresh test database after run the test to avoid generating dummy data
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // 1. Basic 200 request test
        // ----------------------------
        // $response = $this->get('/');
        // $response->assertStatus(200);

        // 2. Template assertion to make sure you see something
        // ----------------------------
        // $response = $this->get('/')->assertSee('Blade template');

        // 3. Test the archives() in app/Providers/AppServiceProvider.php        
        // ----------------------------
        // Given I have two records in the database that are posts
        // and each one is poasted a month apart
        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
            'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);

        // When I fetch the archives
        $posts = Post::archives();

        // Then the response should be in the proper format
        // $this->assertCount(2, $posts);
        // To be more specific:
        $this->assertEquals([
            'year' => $first->created_at->format('Y'),
            'month' => (int)($first->created_at->format('m')),
            'published' => 1
        ], [
            'year' => $second->created_at->format('Y'),
            'month' => (int)($second->created_at->format('m')),
            'published' => 1
        ]);
    }
}
