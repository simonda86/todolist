<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class AuthenticationTest extends TestCase {

    use DatabaseTransactions;

    /**
     * Test new user registration
     *
     * @return void
     */
    public function test_new_user_registration()
    {
        $this->visit('auth/register')
            ->see('Register')
            ->type('Simon', 'name')
            ->type('me@simon-davies.name', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Create account')
            ->seePageIs('app');
    }

    public function test_user_login()
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $this->visit('auth/login')
            ->type($user->email, 'email')
            ->type('password', 'password')
            ->press('Log in')
            ->seePageIs('app');
    }

    public function test_user_login_wrong_password()
    {
        $user = factory(User::class)->create();

        $this->visit('auth/login')
            ->type($user->email, 'email')
            ->type('wrong password', 'password')
            ->press('Log in')
            ->see('Whoops')
            ->seePageIs('auth/login');
    }

}