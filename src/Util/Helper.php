<?php
declare(strict_types=1);

namespace Yproximite\Api\Util;

use Yproximite\Api\Message\MessageInterface;

/**
 * Class Helper
 */
final class Helper
{
    /**
     * @param MessageInterface[] $messages
     *
     * @return array
     */
    public static function buildMessages(array $messages): array
    {
        return array_map(function (MessageInterface $message) {
            return $message->build();
        }, $messages);
    }
}
