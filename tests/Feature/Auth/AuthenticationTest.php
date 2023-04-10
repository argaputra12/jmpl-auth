<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Biscolab\ReCaptcha\Facades\ReCaptcha;
use Biscolab\ReCaptcha\ReCaptchaBuilderV3;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    // $user = User::factory()->create();

    // $response = $this->post('/login', [
    //     'email' => $user->email,
    //     'password' => 'password',
    // ]);

    // $this->assertAuthenticated();
    // $response->assertRedirect(RouteServiceProvider::HOME);

    $this->visit('/login');

    ReCaptcha::shouldReceive('verify')
        ->once()
        ->andReturn(true);

    ReCaptcha::shouldReceive('getScore')
        ->once()
        ->andReturn(0.9);

    $user = User::factory()->create();

    $this->type($user->email, 'email');
    $this->type($user->password, 'password');



});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});