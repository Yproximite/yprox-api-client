<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Field;

use Yproximite\Api\Util\Helper;
use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;

/**
 * Class AbstractFieldMessage
 */
abstract class AbstractFieldMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $description;

    /**
     * @var FieldTranslationMessage[]
     */
    private $translations = [];

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return FieldTranslationMessage[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @param FieldTranslationMessage $translation
     */
    public function addTranslation(FieldTranslationMessage $translation)
    {
        $this->translations[] = $translation;
    }

    /**
     * @param FieldTranslationMessage $translation
     */
    public function removeTranslation(FieldTranslationMessage $translation)
    {
        array_splice($this->translations, array_search($translation, $this->translations), 1);
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
            'token'        => $this->getToken(),
            'description'  => $this->getDescription(),
            'translations' => Helper::buildMessages($this->getTranslations(), 'locale'),
        ];
    }
}
