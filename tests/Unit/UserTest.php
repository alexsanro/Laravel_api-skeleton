<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
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
     * Test nuevo usuario OK
     */
    public function testSignUpValidationError(){
        $response = $this->json(
            'POST',
            '/api/signup',
            [
                'email' => 'prueba1@gmail.com',
                'password' => '1234567890123'
            ]
        );

        $response->assertStatus(422)->assertJsonValidationErrors(['name' => "The name field is required."]);
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
