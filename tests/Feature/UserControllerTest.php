<?php

use App\Models\User;
use Illuminate\Http\Response;

test('user can signup', function () {
    $fields = User::factory()->makeOne();

  $this->post('/api/register', [
        'name' => $fields->name,
        'email' => $fields->email,
        'password' => $fields->password,
        'password_confirmation' => $fields->password
    ])->assertStatus(Response::HTTP_CREATED);
});

test('user can login', function () {
    $user = User::factory()->createOne([
        'password' => 'hello'
    ]);

    $this->post('/api/login', [
        'email' => $user->email,
        'password' => 'hello',
    ])->assertStatus(Response::HTTP_OK);
});
