<?php

namespace spec\Yproximite\Api\Message\Field;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Field\FieldPostMessage;
use Yproximite\Api\Message\Field\FieldTranslationMessage;

class FieldPostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FieldPostMessage::class);
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
}
