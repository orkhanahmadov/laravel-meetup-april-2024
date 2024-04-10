<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class CreateStripeCustomerController
{
    public function __invoke(Request $request): JsonResponse
    {
        $stripe = new StripeClient('secret-key');
        $customer = $stripe->customers->create([
            'email' => $request->input('email'),
        ]);

        return response()->json($customer->toArray());
    }
}
