<?php

namespace Tests\Feature\Http\Controllers\Webhooks;

use Aws\Sns\Exception\InvalidSnsMessageException;
use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Tests\TestCase;

class SnsWebhookControllerTest extends TestCase
{
    public function testSuccessfullyHandlesIncomingWebhookRequest(): void
    {
        $attributes = [
            'Message' => 'foo',
            'MessageId' => 'foo',
            'Timestamp' => 'foo',
            'TopicArn' => 'foo',
            'Type' => 'foo',
            'Signature' => 'foo',
            'SignatureVersion' => 'foo',
            'SigningCertURL' => 'foo',
        ];

        $validator = $this->mock(MessageValidator::class);
        $validator->shouldReceive('validate')
            ->withArgs(fn (Message $message): bool => $message->toArray() === $attributes)
            ->once();

        $this->postJson(route('api.webhooks.sns'), $attributes)
            ->assertNoContent();
    }

    public function testHandlesFailureGracefully(): void
    {
        $validator = $this->mock(MessageValidator::class);
        $validator->shouldReceive('validate')->once()->andThrow(InvalidSnsMessageException::class);

        $this->postJson(route('api.webhooks.sns'), [
            'Message' => 'foo',
            'MessageId' => 'foo',
            'Timestamp' => 'foo',
            'TopicArn' => 'foo',
            'Type' => 'foo',
            'Signature' => 'foo',
            'SignatureVersion' => 'foo',
            'SigningCertURL' => 'foo',
        ])
            ->assertBadRequest();
    }
}
