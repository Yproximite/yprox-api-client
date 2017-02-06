<?php

namespace spec\Yproximite\Api\Message\Location;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Location\Location;
use Yproximite\Api\Model\Location\LocationTranslation;
use Yproximite\Api\Message\Location\LocationPatchMessage;
use Yproximite\Api\Message\Location\LocationTranslationMessage;

class LocationPatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LocationPatchMessage::class);
    }

    function it_should_build()
    {
        $translation = new LocationTranslationMessage();
        $translation->setLocale('en');
        $translation->setTitle('Some location');
        $translation->setOpeningHours('24/7');

        $this->setTel('+1 123 456 78 90');
        $this->setTel2('+2 456 111 78 90');
        $this->setFax('+3 111 222 78 11');
        $this->setMail('mail@location.at');
        $this->setAddress('88 St Patrick St');
        $this->setPostalCode('M5T 1V1');
        $this->setTown('Toronto');
        $this->setCountry('Canada');
        $this->setAddressForGoogleMap('88 St Patrick St, Toronto, M5T 1V1, Canada');
        $this->setDefaultLocation(true);
        $this->setLatitude('43.6527222');
        $this->setLongitude('-79.3918831');
        $this->addTranslation($translation);

        $translationData = [
            'title'        => 'Some location',
            'openingHours' => '24/7',
        ];

        $data = [
            'tel'                 => '+1 123 456 78 90',
            'tel2'                => '+2 456 111 78 90',
            'fax'                 => '+3 111 222 78 11',
            'mail'                => 'mail@location.at',
            'address'             => '88 St Patrick St',
            'postalCode'          => 'M5T 1V1',
            'town'                => 'Toronto',
            'country'             => 'Canada',
            'addressForGoogleMap' => '88 St Patrick St, Toronto, M5T 1V1, Canada',
            'defaultLocation'     => true,
            'latitude'            => '43.6527222',
            'longitude'           => '-79.3918831',
            'translations'        => ['en' => $translationData]
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_location(Location $location, LocationTranslation $translation)
    {
        $translation->getLocale()->willReturn('en');
        $translation->getTitle()->willReturn('Some location');
        $translation->getOpeningHours()->willReturn('24/7');

        $location->getId()->willReturn(1);
        $location->getTel()->willReturn('+1 123 456 78 90');
        $location->getFax()->willReturn('+3 111 222 78 11');
        $location->getMail()->willReturn('mail@location.at');
        $location->getAddress()->willReturn('88 St Patrick St');
        $location->getPostalCode()->willReturn('M5T 1V1');
        $location->getTown()->willReturn('Toronto');
        $location->getCountry()->willReturn('Canada');
        $location->isDefaultLocation()->willReturn(true);
        $location->getLatitude()->willReturn('43.6527222');
        $location->getLongitude()->willReturn('-79.3918831');
        $location->getTranslations()->willReturn([$translation]);

        $transMessage = new LocationTranslationMessage();
        $transMessage->setLocale('en');
        $transMessage->setTitle('Some location');
        $transMessage->setOpeningHours('24/7');

        $message = new LocationPatchMessage();
        $message->setId(1);
        $message->setTel('+1 123 456 78 90');
        $message->setFax('+3 111 222 78 11');
        $message->setMail('mail@location.at');
        $message->setAddress('88 St Patrick St');
        $message->setPostalCode('M5T 1V1');
        $message->setTown('Toronto');
        $message->setCountry('Canada');
        $message->setDefaultLocation(true);
        $message->setLatitude('43.6527222');
        $message->setLongitude('-79.3918831');
        $message->addTranslation($transMessage);

        $this::createFromLocation($location)->shouldBeLike($message);
    }
}
