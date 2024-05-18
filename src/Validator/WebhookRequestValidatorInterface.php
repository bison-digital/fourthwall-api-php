<?php

namespace Fourthwall\Validator;

use Psr\Http\Message\RequestInterface;

interface WebhookRequestValidatorInterface {

    public function validate(RequestInterface $request): void;
}