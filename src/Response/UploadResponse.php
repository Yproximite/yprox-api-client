<?php

declare(strict_types=1);

namespace Yproximite\Api\Response;

class UploadResponse extends Response
{
    public function getUploadedMedias(): array
    {
        return null === $this->data ? [] : $this->data['uploadMedias'];
    }
}
