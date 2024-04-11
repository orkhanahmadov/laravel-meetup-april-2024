<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;

class RegistrationPageController
{
    public function __invoke(Application $app): View
    {
        if ($app->environment('staging')) {
            abort(Response::HTTP_FORBIDDEN, 'Registration is disabled in staging environment');
        }

        return view('registration');
    }
}
