<?php

declare(strict_types=1);

namespace Fourthwall\Validator;

use Fourthwall\Exception\InvalidWebhookRequestException;
use Psr\Http\Message\RequestInterface;

final readonly class SignatureVerifier implements WebhookRequestValidatorInterface {

    public function __construct(
        private string $secret
    ) {
    }

    /**
     * @throws InvalidWebhookRequestException
     */
    public function validate(RequestInterface $request): void {
        $hmacHeader = $request->getHeaderLine('X-Fourthwall-Hmac-SHA256');
        $body = (string) $request->getBody();

        $computedHmac = base64_encode(
            hash_hmac('sha256', $body, $this->secret, true)
        );

        if (!hash_equals($computedHmac, $hmacHeader)) {
            throw new InvalidWebhookRequestException('Failed to verify webhook signature.');
        }
    }
}