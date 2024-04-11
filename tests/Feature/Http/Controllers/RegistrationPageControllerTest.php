<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Application;
use Tests\TestCase;

class RegistrationPageControllerTest extends TestCase
{
    public function testPageLoadsSuccessfully(): void
    {
        $this->get(route('register'))->assertOk();
    }

    public function testOnStagingShouldAbort(): void
    {
        $app = \Mockery::mock(Application::class);
        $app->shouldReceive('environment')->once()->with('staging')->andReturnTrue();

        $this->instance(Application::class, $app);

        $this->get(route('register'))->assertForbidden();
    }
}
