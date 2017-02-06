<?php

namespace spec\Yproximite\Api\Model\Location;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Location\LocationTranslation;

class LocationTranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LocationTranslation::class);
    }

    function let()
    {
        $data = [
            'locale'       => 'en',
            'title'        => 'Some location',
            'openingHours' => '24/7',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getLocale()->shouldReturn('en');
        $this->getTitle()->shouldReturn('Some location');
        $this->getOpeningHours()->shouldReturn('24/7');
    }
}
