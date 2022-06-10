<?php

namespace Tests\Feature\Users;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserStoreCheckTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed('RoleAndPermissionSeeder');
        $this->seed('UserSeeder');
    }

    public function postUser($overrides = [])
    {
        $user = User::factory()->make($overrides);

        return $this->postJson(route('user.store'), $user->toArray());
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_requires_a_name()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['name' => NULL])->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_name_can_be_max_255_characters()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['name' => str_repeat('a', 256)])
            ->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_name_must_be_unique()
    {
        $admin = User::find(3);
        $user = User::find(1);
        $this->actingAs($admin);
        $this->postUser(['user' => $user->user])->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_email_can_be_max_255_characters()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['email' => str_repeat('a', 256)])
            ->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_requires_a_password()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['password' => NULL])->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_password_must_be_at_least_8_characters()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['password' => str_repeat('a', 7)])
            ->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_password_can_be_max_255_characters()
    {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['password' => str_repeat('a', 256)])
            ->assertStatus(422);
    }
}
