<?php

namespace App\Exceptions;

use Exception;

class BusinessException extends Exception
{
    protected int $statusCode;
    protected array $context;

    public function __construct(
        string $message,
        int $statusCode = 400,
        array $context = []
    ) {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->context = $context;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
