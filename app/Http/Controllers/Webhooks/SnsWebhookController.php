<?php

namespace App\Http\Controllers\Webhooks;

use Aws\Sns\Exception\InvalidSnsMessageException;
use Aws\Sns\Message;
use Aws\Sns\MessageValidator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SnsWebhookController
{
    public function __invoke(Request $request): Response
    {
        try {
            $validator = new MessageValidator();
            $validator->validate(new Message($request->json()->all()));
        } catch (InvalidSnsMessageException) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        // SNS `Message` attribute is a stringified JSON object
        $snsMessage = json_decode($request->json('Message'), true);

        // do something with $snsMessage

        return response()->noContent();
    }
}
