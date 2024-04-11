<?php

namespace App\Http\Controllers;

use App\Services\Stripe;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CreateStripeCustomerController
{
    public function __invoke(Request $request, Stripe $stripe): JsonResponse
    {
        $customer = $stripe->createCustomer([
            'email' => $request->input('email'),
        ]);

        return response()->json($customer->toArray());
    }
}
