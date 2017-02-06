<?php

namespace spec\Yproximite\Api\Message\Field;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Field\Field;
use Yproximite\Api\Model\Field\FieldTranslation;
use Yproximite\Api\Message\Field\FieldPatchMessage;
use Yproximite\Api\Message\Field\FieldTranslationMessage;

class FieldPatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FieldPatchMessage::class);
    }

    function it_should_build()
    {
        $translation = new FieldTranslationMessage();
        $translation->setLocale('en');
        $translation->setValue('Secret');

        $this->setToken('some-field');
        $this->setDescription('Some description');
        $this->addTranslation($translation);

        $transData = [
            'value' => 'Secret',
        ];

        $data = [
            'token' => 'some-field',
            'description' => 'Some description',
            'translations' => ['en' => $transData],
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_field(Field $field, FieldTranslation $translation)
    {
        $translation->getLocale()->willReturn('en');
        $translation->getValue()->willReturn('Some field');

        $field->getId()->willReturn(1);
        $field->getToken()->willReturn('some-field');
        $field->getDescription()->willReturn('Top-secret');
        $field->getTranslations()->willReturn([$translation]);

        $transMessage = new FieldTranslationMessage();
        $transMessage->setLocale('en');
        $transMessage->setValue('Some field');

        $message = new FieldPatchMessage();
        $message->setId(1);
        $message->setToken('some-field');
        $message->setDescription('Top-secret');
        $message->addTranslation($transMessage);

        $this::createFromField($field)->shouldBeLike($message);
    }
}
