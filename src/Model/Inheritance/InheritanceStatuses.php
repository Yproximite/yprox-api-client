<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Inheritance;

/**
 * Class InheritanceStatuses
 */
class InheritanceStatuses
{
    const NONE       = 'none';
    const INHERITED  = 'inherited';
    const OVERRIDDEN = 'overridden';

    /**
     * @return string[]
     */
    public static function getValues(): array
    {
        return [
            self::NONE,
            self::INHERITED,
            self::OVERRIDDEN,
        ];
    }
}
