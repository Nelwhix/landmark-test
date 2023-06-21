<?php

use App\Models\User;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

function login($user = null) {
    return test()->actingAs($user ?? User::factory()->create());
}
