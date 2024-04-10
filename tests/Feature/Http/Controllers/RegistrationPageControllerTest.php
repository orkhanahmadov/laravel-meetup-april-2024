<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class RegistrationPageControllerTest extends TestCase
{
    public function testPageLoadsSuccessfully(): void
    {
        $this->get(route('register'))->assertOk();
    }
}
