<?php

declare(strict_types=1);

namespace Yproximite\Api\Response;

class UploadResponse extends AbstractResponse
{
    public function getUploadedMedias(): object
    {
        return (object) ($this->data->uploadMedias ?? []);
    }
}
