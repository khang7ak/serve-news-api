<?php

namespace Tests\Unit\Controller;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\PostController;
use App\Post;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Auth;

class PostControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_list_messages()
    {

        $message = factory('App\Post')->create();
        $response = $this->get('/home');
        $response->assertSee($message->message_title);
    }

    // logged user getting one messgae
    public function test_user_can_read_single_message()
    {
        $message = factory('App\Message')->create();
        $response = $this->get('/inbox/'.$message->id);
        $response->assertSee($message->message_title)
            ->assertSee($message->message_body);
    }

    // logged user inserting stuff test
    public function test_logged_users_can_create_a_new_message()
    {
        $this->actingAs(factory('App\User')->create());
        $message = factory('App\Message')->make();
        $this->post('/inbox/create',$message->toArray());
        $this->assertEquals(1,Message::all()->count());
    }

    //validation test
    public function test_message_requires_a_title()
    {
        $this->actingAs(factory('App\User')->create());
        $message = factory('App\Message')->make(['message_title' => null]);
        $this->post('/inbox/create',$message->toArray())
            ->assertSessionHasErrors('message_title');
    }

    //validation test
    public function test_message_requires_a_message_body()
    {
        $this->actingAs(factory('App\User')->create());
        $message = factory('App\Message')->make(['message_body' => null]);
        $this->post('/inbox/create',$message->toArray())
            ->assertSessionHasErrors('message_body');
    }

    // test authorized user to update
    public function test_authorized_user_can_update_the_message()
    {

        $this->actingAs(factory('App\User')->create());
        $message = factory('App\Message')->create(['user_id' => Auth::id()]);
        $message->message_title = "Updated Title";
        $this->put('/inbox/'.$message->id, $message->toArray());
        $this->assertDatabaseHas('messages',['id'=> $message->id , 'message_title' => 'Updated Title']);

    }

    // test authorized user to delete
    public function test_authorized_user_can_delete_the_message()
    {

        $this->actingAs(factory('App\User')->create());
        $message = factory('App\Message')->create(['user_id' => Auth::id()]);
        $this->delete('/inbox/'.$message->id);
        $this->assertDatabaseMissing('messages',['id'=> $message->id]);

    }

    // test unauthorized user to delete
    public function test_unauthorized_user_cannot_delete_the_task()
    {
        $this->actingAs(factory('App\User')->create());
        $task = factory('App\Message')->create();
        $response = $this->delete('/inbox/'.$task->id);
        $response->assertStatus(403);
    }
}
