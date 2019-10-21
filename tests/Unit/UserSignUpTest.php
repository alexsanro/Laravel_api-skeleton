<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSignUpTest extends TestCase
{

    public function setup(): void{
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'aplication/json',
            'Content-type' => 'aplication/json',
            'X-Requested-With' => 'XMLHttpRequest'
        ]);
    }

    /**
     * SIGNUP ERROR NAME CAMP REQUIRED
     */
    public function testSignUpValidationErrorNameRequired(){
        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'email' => 'prueba1@gmail.com',
                'password' => '1234567890123'
            ]
        );

        $response->assertStatus(422)
                    ->assertJsonValidationErrors(
                        ['name' => "The name field is required."]
                    );
    }

    /**
     * SIGNUP ERROR EMAIL CAMP REQUIRED
     */
    public function testSignUpValidationErrorEmailRequired(){
        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'name' => 'nombre',
                'email' => '',
                'password' => '1234567890123'
            ]
        );

        $response->assertStatus(422)
                    ->assertJsonValidationErrors(
                        ['email' => "The email field is required."]
                    );
    }

    /**
     * SIGNUP ERROR EMAIL CAMP REQUIRED
     */
    public function testSignUpValidationErrorEmailTypeEmail(){
        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'name' => 'nombre',
                'email' => 'preubasss',
                'password' => '1234567890123'
            ]
        );

        $response->assertStatus(422)
                    ->assertJsonValidationErrors(
                        ['email' => "The email must be a valid email address."]
                    );
    }

    /**
     * Test comprueba acceso Login erroneo
     *
     * @return void
     */
    public function testLoginErrorTest()
    {
        $response = $this->json(
            'POST',
            '/api/login',
            [
                'email' => 'prueba1@gmail.com',
                'password' => 'alexsanro'
            ]
        );

        $response->assertStatus(401);
    }
}
