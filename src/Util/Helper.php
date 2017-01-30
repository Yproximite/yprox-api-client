<?php
declare(strict_types=1);

namespace Yproximite\Api\Util;

use Symfony\Component\PropertyAccess\PropertyAccess;

use Yproximite\Api\Message\MessageInterface;

/**
 * Class Helper
 */
final class Helper
{
    /**
     * @param MessageInterface[] $messages
     * @param string|null        $keyBy
     *
     * @return array
     */
    public static function buildMessages(array $messages, string $keyBy = null): array
    {
        $values = array_map(function (MessageInterface $message) {
            return $message->build();
        }, $messages);

        if (!is_null($keyBy)) {
            $accessor = PropertyAccess::createPropertyAccessor();

            $keys = array_map(function (MessageInterface $message) use ($accessor, $keyBy) {
                return $accessor->getValue($message, $keyBy);
            }, $messages);

            $values = array_combine($keys, $values);
        }

        return $values;
    }
}
