<?php

namespace Tests\Feature\Providers;

use Stripe\StripeClient;
use Tests\TestCase;

class AppServiceProviderTest extends TestCase
{
    public function testBindsStripeClient(): void
    {
        $this->assertTrue($this->app->bound(StripeClient::class));
        $stripe = $this->app->make(StripeClient::class);
        $this->assertSame('fake-secret', $stripe->getApiKey());
    }
}
