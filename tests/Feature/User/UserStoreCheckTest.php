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
        $this->seed('CategorySeeder');
        $this->seed('UserSeeder');

        $this->category = Category::factory()->create();
        $this->user = User::factory()->create();
    }

    public function postUser($overrides = []) {
        $user = User::factory()->make($overrides);

        return $this->postJson(route('users.store'), $user->toArray());
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_requires_a_name() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['user' => NULL])->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_name_can_be_max_100_characters() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['user' => str_repeat('a', 101)])
            ->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_name_must_be_unique() {
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

    function a_user_description_has_to_be_10_characters() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['description' => '0123'])->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_description_can_be_max_300_characters() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['description' => str_repeat('a', 301)])->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_requires_a_price() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['price' => NULL])->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_price_must_be_numeric() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['price' => 'abcdefg'])->assertStatus(422);
    }

    /**
     * @test
     * @group User
     * @group UserStoreCheck
     */

    function a_user_price_can_max_be_999999_99() {
        $admin = User::find(3);
        $this->actingAs($admin);
        $this->postUser(['price' => 1000000.00])->assertStatus(422);
    }
}
