<?php

namespace spec\Yproximite\Api\Model\Field;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Field\FieldTranslation;

class FieldTranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FieldTranslation::class);
    }

    function let()
    {
        $data = [
            'locale' => 'en',
            'value'  => 'Required field',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getLocale()->shouldReturn('en');
        $this->getValue()->shouldReturn('Required field');
    }
}
