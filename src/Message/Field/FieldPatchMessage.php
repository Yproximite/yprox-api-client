<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Field;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\Field\Field;

/**
 * Class FieldPatchMessage
 */
class FieldPatchMessage extends AbstractFieldMessage
{
    use IdentityAwareMessageTrait;

    public static function createFromField(Field $field): self
    {
        $message = new self();
        $message->setId($field->getId());
        $message->setToken($field->getToken());
        $message->setDescription($field->getDescription());

        foreach ($field->getTranslations() as $translation) {
            $transMessage = FieldTranslationMessage::createFromFieldTranslation($translation);

            $message->addTranslation($transMessage);
        }

        return $message;
    }
}
