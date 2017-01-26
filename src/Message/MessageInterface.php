<?php
declare(strict_types=1);

namespace Yproximite\Api\Message;

/**
 * Interface MessageInterface
 */
interface MessageInterface
{
    /**
     * Builds the message
     *
     * @return array
     */
    public function build(): array;
}
