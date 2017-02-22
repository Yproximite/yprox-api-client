<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Field;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Model\Field\FieldTranslation;
use Yproximite\Api\Message\LocaleAwareMessageTrait;

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

    /**
     * @param FieldTranslation $translation
     *
     * @return self
     */
    public static function createFromFieldTranslation(FieldTranslation $translation): self
    {
        $message = new self();
        $message->setLocale($translation->getLocale());
        $message->setValue($translation->getValue());

        return $message;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
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
