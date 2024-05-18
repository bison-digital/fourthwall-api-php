<?php

declare(strict_types=1);

namespace Fourthwall\Validator;

use Psr\Http\Message\RequestInterface;

final class WebhookRequestValidator {
    public function __construct(
        private array $validators,
    ) {
    }

    public function validate(RequestInterface $request): void {
        foreach ($this->validators as $validator){
            $validator->validate($request);
        }
    }

    public function addValidator(WebhookRequestValidatorInterface $validator): self {
        $this->validators[] = $validator;

        return $this;
    }
}