<?php

namespace Tests\Feature\Services;

use App\Services\Stripe;
use Stripe\Customer;
use Stripe\Service\CustomerService;
use Stripe\StripeClient;
use Tests\TestCase;

class StripeTest extends TestCase
{
    public function testCreatesStripeCustomer(): void
    {
        $customer = new Customer();
        $customer->email = 'john@example.com';

        $customerService = \Mockery::mock(CustomerService::class);
        $customerService->shouldReceive('create')
            ->once()
            ->with(['email' => 'example@example.com'])
            ->andReturn($customer);

        $stripe = $this->mock(StripeClient::class);
        $stripe->shouldReceive('getService')->once()->with('customers')->andReturn($customerService);

        $createdCustomer = $this->app->make(Stripe::class)->createCustomer(['email' => 'example@example.com']);

        $this->assertSame($createdCustomer->toArray(), $customer->toArray());
    }
}
