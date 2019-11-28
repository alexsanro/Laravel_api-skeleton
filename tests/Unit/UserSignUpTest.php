<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\User;

class UserSignUpTest extends TestCase
{
    use DatabaseTransactions;

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
     * SIGNUP ERROR EMAIL CAMP UNIQUE
     */
    public function testSignUpValidationErrorEmailUnique(){        
        $user = factory(User::class)->create();

        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'name' => 'nombreprueba',
                'email' => 'prueba@prueba.com',
                'password' => '1234567890123'
            ]
        );

        $response->assertStatus(422)
                    ->assertJsonValidationErrors(
                        ['email' => "The email has already been taken."]
                    );
    }

    /**
     * SIGNUP ERROR PASSWORD CAMP REQUIRED
     */
    public function testSignUpValidationErrorPasswordRequired(){
        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'name' => 'nombre',
                'email' => 'prueba@prueba.com',
                'password' => ''
            ]
        );

        $response->assertStatus(422)
                    ->assertJsonValidationErrors(
                        ['password' => "The password field is required."]
                    );
    }

    /**
     * SIGNUP ERROR PASSWORD CAMP REQUIRED
     */
    public function testSignUpValidationErrorPasswordMinValue(){
        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'name' => 'nombre',
                'email' => 'prueba@prueba.com',
                'password' => 'hola'
            ]
        );

        $response->assertStatus(422)
                    ->assertJsonValidationErrors(
                        ['password' => "The password must be between 6 and 12 characters."]
                    );
    }

    /**
     * SIGNUP ERROR PASSWORD CAMP REQUIRED
     */
    public function testSignUpValidationErrorPasswordMaxValue(){
        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'name' => 'nombre',
                'email' => 'prueba@prueba.com',
                'password' => 'hola123456781'
            ]
        );

        $response->assertStatus(422)
                    ->assertJsonValidationErrors(
                        ['password' => "The password must be between 6 and 12 characters."]
                    );
    }

    /**
     * SIGNUP ERROR PASSWORD CAMP REQUIRED
     */
    public function testSignUpOk(){
        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'name' => 'nombre',
                'email' => 'prueba@prueba.com',
                'password' => 'hola12345'
            ]
        );

        $response->assertJson(
            ["message" => "Successfully created user!"]
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
