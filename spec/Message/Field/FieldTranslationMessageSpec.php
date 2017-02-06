<?php

namespace spec\Yproximite\Api\Message\Field;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Field\FieldTranslation;
use Yproximite\Api\Message\Field\FieldTranslationMessage;

class FieldTranslationMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FieldTranslationMessage::class);
    }

    function it_should_build()
    {
        $this->setLocale('en');
        $this->setValue('Some data');

        $data = [
            'value' => 'Some data',
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_field_translation(FieldTranslation $translation)
    {
        $translation->getLocale()->willReturn('en');
        $translation->getValue()->willReturn('Some data');

        $message = new FieldTranslationMessage();
        $message->setLocale('en');
        $message->setValue('Some data');

        $this::createFromFieldTranslation($translation)->shouldBeLike($message);
    }
}
