<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\Field\Field;
use Yproximite\Api\Message\Field\FieldListMessage;
use Yproximite\Api\Message\Field\FieldPostMessage;
use Yproximite\Api\Message\Field\FieldPatchMessage;
use Yproximite\Api\Message\Field\FieldOverrideMessage;

/**
 * Class FieldService
 */
class FieldService extends AbstractService implements ServiceInterface
{
    /**
     * @param FieldListMessage $message
     *
     * @return Field[]
     */
    public function getFields(FieldListMessage $message): array
    {
        $path = sprintf('sites/%d/fields', $message->getSiteId());

        $response = $this->getClient()->sendRequest('GET', $path);

        /** @var Field[] $models */
        $models = $this->getModelFactory()->createMany(Field::class, $response);

        return $models;
    }

    /**
     * @param FieldPostMessage $message
     *
     * @return Field
     */
    public function postField(FieldPostMessage $message): Field
    {
        $path = sprintf('sites/%d/fields', $message->getSiteId());
        $data = ['api_field' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var Field $model */
        $model = $this->getModelFactory()->create(Field::class, $response);

        return $model;
    }

    /**
     * @param FieldPatchMessage $message
     *
     * @return Field
     */
    public function patchField(FieldPatchMessage $message): Field
    {
        $path = sprintf('sites/%d/fields/%d', $message->getSiteId(), $message->getId());
        $data = ['api_field' => $message->build()];

        $response = $this->getClient()->sendRequest('PATCH', $path, $data);

        /** @var Field $model */
        $model = $this->getModelFactory()->create(Field::class, $response);

        return $model;
    }

    /**
     * @param FieldOverrideMessage $message
     *
     * @return Field
     */
    public function overrideField(FieldOverrideMessage $message): Field
    {
        $path = sprintf('sites/%d/fields/%d/override', $message->getSiteId(), $message->getId());

        $response = $this->getClient()->sendRequest('GET', $path);

        /** @var Field $model */
        $model = $this->getModelFactory()->create(Field::class, $response);

        return $model;
    }
}
