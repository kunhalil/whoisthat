<?php

namespace Tests;

use App\Models\User;
use Tests\TestCase;

abstract class ApiTestCase extends TestCase
{
    protected $token;

    public function setUp(): void
    {
        parent::setUp();

        // For API test we need to ensure we have a token ready
        $user = User::first();
        $this->token = $user->createToken('authToken')->plainTextToken;
    }
}
