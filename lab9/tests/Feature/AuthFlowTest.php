<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_success_redirects(): void
    {
        $user = User::factory()->create(['password' => bcrypt('password123')]);
        $res = $this->post('/login', ['email'=>$user->email,'password'=>'password123']);
        $res->assertStatus(302);
    }

    public function test_guest_redirected_from_create(): void
    {
        $res = $this->get('/articles/create');
        $res->assertStatus(302);
    }
}
