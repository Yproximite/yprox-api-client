<?php

namespace Yproximite\Api\Exception;

class FileNotFoundException extends YproxApiClientBaseException
{
    public function _construct(string $filename) {
        parent::__construct(sprintf('File « %s » not found.'));
    }
}
