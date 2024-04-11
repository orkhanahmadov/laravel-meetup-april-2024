<?php

namespace Tests\Feature\Http\Controllers;

use App\Services\Stripe;
use Stripe\Customer;
use Tests\TestCase;

class CreateStripeCustomerControllerTest extends TestCase
{
    public function testCreatesStripeCustomerAndReturnsIt(): void
    {
        $customer = new Customer();
        $customer->email = 'john@example.com';

        $stripe = $this->mock(Stripe::class);
        $stripe->shouldReceive('createCustomer')
            ->once()
            ->with(['email' => 'example@example.com'])
            ->andReturn($customer);

        $this->post(route('stripe.customers.create'), [
                'email' => 'example@example.com',
            ])
            ->assertOk()
            ->assertExactJson(['email' => 'john@example.com']);
    }
}
