<?php

declare(strict_types=1);

namespace Yproximite\Api\Response;

class AbstractResponse
{
    /** @var array|null */
    protected $data;
    /** @var array */
    protected $errors;
    /** @var array */
    protected $warnings;

    public function __construct(array $payload)
    {
        $this->data     = $payload['data'] ?? null;
        $this->errors   = $payload['errors'] ?? [];
        $this->warnings = $payload['extensions']['warnings'] ?? [];
    }

    public function hasErrors(): bool
    {
        return \count($this->errors) > 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasWarnings(): bool
    {
        return \count($this->warnings) > 0;
    }

    public function getWarnings(): array
    {
        return $this->warnings;
    }
}
