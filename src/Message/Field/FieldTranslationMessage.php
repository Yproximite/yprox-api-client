<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Field;

use Yproximite\Api\Message\LocaleAwareMessageTrait;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Model\Field\FieldTranslation;

/**
 * Class FieldTranslationMessage
 */
class FieldTranslationMessage implements MessageInterface
{
    use LocaleAwareMessageTrait;

    /**
     * @var string
     */
    private $value;

    public static function createFromFieldTranslation(FieldTranslation $translation): self
    {
        $message = new self();
        $message->setLocale($translation->getLocale());
        $message->setValue($translation->getValue());

        return $message;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'value' => $this->getValue(),
        ];
    }
}
