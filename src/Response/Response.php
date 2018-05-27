<?php

declare(strict_types=1);

namespace Yproximite\Api\Response;

class Response extends AbstractResponse
{
    /**
     * @return null|object
     */
    public function getData(): ?object
    {
        return $this->data;
    }
}
