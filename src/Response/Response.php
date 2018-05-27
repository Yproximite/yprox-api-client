<?php

declare(strict_types=1);

namespace Yproximite\Api\Response;

class Response extends AbstractResponse
{
    public function getData(): ?array
    {
        return $this->data;
    }
}
