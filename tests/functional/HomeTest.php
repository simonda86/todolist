<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test home page
     *
     * @return void
     */
    public function test_homepage()
    {
        $this->visit('/')
             ->see('TodoList');
    }

    /**
     * Test sign up link
     *
     * @return void
     */
    public function test_signup_link()
    {
        $this->visit('/')
            ->click('Sign up')
            ->see('Register')
            ->seePageIs('auth/register');
    }

    /**
     * Test login login
     *
     * @return void
     */
    public function test_login_link()
    {
        $this->visit('/')
            ->click('Log in')
            ->see('Login')
            ->seePageIs('auth/login');
    }
}
