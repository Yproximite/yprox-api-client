<?php

namespace spec\Yproximite\Api\Model\Location;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Inheritance\InheritanceStatuses;
use Yproximite\Api\Model\Location\Location;

class LocationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Location::class);
    }

    function let()
    {
        $translation = [
            'title'        => 'Some location',
            'openingHours' => '24/7',
        ];

        $data = [
            'id'                 => '3',
            'tel'                => '+1 123 456 78 90',
            'fax'                => '+2 456 111 78 90',
            'mail'               => 'mail@location.at',
            'address'            => '88 St Patrick St',
            'postalCode'         => 'M5T 1V1',
            'town'               => 'City',
            'latitude'           => '43.6527222',
            'longitude'          => '-79.3918831',
            'country'            => 'Canada',
            'defaultLocation'    => 0,
            'dataParent'         => '11',
            'translations'       => ['en' => $translation],
            'inheritance_status' => 'overridden',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(3);
        $this->getTel()->shouldReturn('+1 123 456 78 90');
        $this->getFax()->shouldReturn('+2 456 111 78 90');
        $this->getMail()->shouldReturn('mail@location.at');
        $this->getAddress()->shouldReturn('88 St Patrick St');
        $this->getPostalCode()->shouldReturn('M5T 1V1');
        $this->getTown()->shouldReturn('City');
        $this->getLatitude()->shouldReturn('43.6527222');
        $this->getLongitude()->shouldReturn('-79.3918831');
        $this->getCountry()->shouldReturn('Canada');
        $this->isDefaultLocation()->shouldReturn(false);
        $this->getDataParentId()->shouldReturn(11);
        $this->getTranslations()->shouldHaveCount(1);
        $this->getInheritanceStatus()->shouldReturn(InheritanceStatuses::OVERRIDDEN);
    }
}
