<?php

namespace Yproximite\Api;

class Response
{
    private $data;
    private $errors;
    private $warnings;

    public function __construct(array $payload)
    {
        $this->data     = null === ($data = $payload['data'] ?? null) ? null : (object) $data;
        $this->errors   = $payload['errors'] ?? [];
        $this->warnings = $payload['extensions']['warnings'] ?? [];
    }

    /**
     * @return null|object
     */
    public function getData()
    {
        return $this->data;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasWarnings(): bool
    {
        return count($this->warnings) > 0;
    }

    public function getWarnings(): array
    {
        return $this->warnings;
    }
}
