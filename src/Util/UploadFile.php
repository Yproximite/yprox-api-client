<?php

namespace Yproximite\Api\Util;

use Yproximite\Api\Exception\FileNotFoundException;

class UploadFileNormalizer
{
    private $path;
    private $name;
    private $content;

    /**
     * @param $file array|string
     */
    public function __construct($payload)
    {
        if (\is_string($payload)) {
            $this->path = $payload;
        } elseif (\is_array($payload)) {
            $this->path = $payload['path'] ?? null;
            $this->name = $payload['name'] ?? null;
        }

        if (!file_exists($this->path)) {
            throw new FileNotFoundException($this->path);
        }

        $this->name = $this->name ?? basename($this->path);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getContent(): string
    {
        if ($this->content === null) {
            set_error_handler(function ($type, $msg) use (&$error) { $error = $msg; });
            $content = file_get_contents($this->path);
            restore_error_handler();

            if (false === $content) {
                throw new \RuntimeException($error);
            }

            $this->content = $content;
        }

        return $this->content;
    }
}
