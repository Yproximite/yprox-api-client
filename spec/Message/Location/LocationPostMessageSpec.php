<?php

namespace spec\Yproximite\Api\Message\Location;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Location\LocationPostMessage;
use Yproximite\Api\Message\Location\LocationTranslationMessage;

class LocationPostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LocationPostMessage::class);
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
}
