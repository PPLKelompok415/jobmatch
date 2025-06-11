<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Test Register Applicant.
     *
     * @return void
     */
    public function test_register_applicant(): void
    {
        $response = $this->get('/register/applicant');

        $response->assertStatus(200); // Verifikasi bahwa status HTTP adalah 200 (OK)
        $response->assertSee('Register'); // Memastikan bahwa halaman mengandung kata "Register"
    }

    /**
     * Test Register Company.
     *
     * @return void
     */
    public function test_register_company(): void
    {
        $response = $this->get('/register/company');

        $response->assertStatus(200); 
        $response->assertSee('Register'); // Memastikan bahwa halaman mengandung kata "Register"
    }

    /**
     * Test Login Company.
     *
     * @return void
     */
    public function test_login_company(): void
    {
        $response = $this->get('/login/company');

        $response->assertStatus(200); 
        $response->assertSee('Login'); // Memastikan bahwa halaman mengandung kata "Login"
    }

    /**
     * Test Login Applicant.
     *
     * @return void
     */
    public function test_login_applicant(): void
    {
        $response = $this->get('/login/applicant');

        $response->assertStatus(200); 
        $response->assertSee('Login'); // Memastikan bahwa halaman mengandung kata "Login"
    }

    /**
     * Test Login Admin.
     *
     * @return void
     */
    public function test_login_admin(): void
    {
        $response = $this->get('/login/admin');

        $response->assertStatus(200); 
        $response->assertSee('Login'); // Memastikan bahwa halaman mengandung kata "Login"
    }
}
