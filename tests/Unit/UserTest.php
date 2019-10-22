<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void{
        parent::setUp();
        $this->withHeaders([
            'Accept' => 'aplication/json',
            'Content-type' => 'aplication/json',
            'X-Requested-With' => 'XMLHttpRequest'
        ]);
    }

    /**
     * Test comprueba acceso Login erroneo
     *
     * @return void
     */
    public function testLoginErrorValidationTest()
    {
        $response = $this->json(
            'POST',
            '/api/login',
            [
                'email' => 'prueba1',
                'password' => 'alexsanro'
            ]
        );

        $response->assertStatus(422)
                    ->assertJsonValidationErrors(
                        ['email' => "The email must be a valid email address."]
                    );
    }


    /**
     * Test comprueba que pasa la validación pero el usuario no existe
     */
    public function testLoginAuthKo(){
        $response = $this->json(
            'POST',
            '/api/login',
            [
                'email' => 'prueba1@gmail.com',
                'password' => 'alexsanro'
            ]
        );

        $response->assertStatus(401)
                    ->assertExactJson(
                        ['message' => 'Unauthorized']
                    );
    }

    /**
     * Test comprueba que pasa la validación
     */
    public function testLoginAuthOk(){
        $user = factory(User::class)->create([
            'email' => 'prueba@prueba.com',
            'password' => bcrypt('pruebasss')
        ]);

        $response = $this->json(
            'POST',
            '/api/login',
            [
                'email' => 'prueba@prueba.com',
                'password' => 'pruebasss'
            ]
        );

        print_r($response->json());

        $response->assertStatus(401)
                    ->assertExactJson(
                        ['message' => 'Unauthorized']
                    );
    }
}
