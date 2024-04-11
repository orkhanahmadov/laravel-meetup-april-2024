<?php

namespace App\Services;

use Stripe\Customer;
use Stripe\StripeClient;

class Stripe
{
    public function __construct(private readonly StripeClient $stripeClient)
    {
    }

    public function createCustomer(array $attributes): Customer
    {
        return $this->stripeClient->customers->create($attributes);
    }
}
