<?php

namespace spec\Yproximite\Api\Message\Location;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Location\LocationTranslation;
use Yproximite\Api\Message\Location\LocationTranslationMessage;

class LocationTranslationMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LocationTranslationMessage::class);
    }

    function it_should_build()
    {
        $this->setTitle('Some location');
        $this->setOpeningHours('24/7');

        $data = [
            'title'        => 'Some location',
            'openingHours' => '24/7',
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_article_translation(LocationTranslation $translation)
    {
        $translation->getLocale()->willReturn('en');
        $translation->getTitle()->willReturn('Big title');
        $translation->getOpeningHours()->willReturn('24/7');

        $message = new LocationTranslationMessage();
        $message->setLocale('en');
        $message->setTitle('Big title');
        $message->setOpeningHours('24/7');

        $this::createFromLocationTranslation($translation)->shouldBeLike($message);
    }
}
