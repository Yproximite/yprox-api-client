<?php
declare(strict_types=1);

namespace Yproximite\Api\Factory;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class ModelFactory
 */
class ModelFactory
{
    /**
     * @param string $class
     * @param array  $data
     *
     * @return ModelInterface
     */
    public function create(string $class, array $data): ModelInterface
    {
        return new $class($data);
    }
}
