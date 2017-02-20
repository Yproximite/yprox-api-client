<?php
declare(strict_types=1);

namespace Yproximite\Api\Exception;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class TransferException
 */
class TransferException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var RequestInterface|null
     */
    private $request;

    /**
     * @var ResponseInterface|null
     */
    private $response;

    /**
     * @param string                 $message
     * @param RequestInterface|null  $request
     * @param ResponseInterface|null $response
     * @param \Exception|null        $previous
     */
    public function __construct(
        string $message,
        RequestInterface $request = null,
        ResponseInterface $response = null,
        \Exception $previous = null
    ) {
        parent::__construct($message, 0, $previous);

        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * @return null|RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return null|ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }
}
