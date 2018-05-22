<?php

namespace Yproximite\Api\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpException extends YproxApiClientBaseException
{
    private $request;
    private $response;

    public function __construct(string $message, RequestInterface $request, ResponseInterface $response)
    {
        parent::__construct($message);
        $this->request  = $request;
        $this->response = $response;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
