<?php

declare(strict_types=1);

namespace Yproximite\Api\Exception;

class FileNotFoundException extends YproxApiClientBaseException
{
    public function __construct(string $filename)
    {
        parent::__construct(sprintf('File « %s » not found.', $filename));
    }
}
