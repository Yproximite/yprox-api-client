<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Inheritance;

/**
 * Class InheritanceStatuses
 */
class InheritanceStatuses
{
    const INHERITANCE_STATUS_NONE       = 'none';
    const INHERITANCE_STATUS_INHERITED  = 'inherited';
    const INHERITANCE_STATUS_OVERRIDDEN = 'overridden';

    /**
     * @return string[]
     */
    public static function getValues(): array
    {
        return [
            self::INHERITANCE_STATUS_NONE,
            self::INHERITANCE_STATUS_INHERITED,
            self::INHERITANCE_STATUS_OVERRIDDEN,
        ];
    }
}
