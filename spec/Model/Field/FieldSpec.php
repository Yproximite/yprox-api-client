<?php

namespace spec\Yproximite\Api\Model\Field;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Field\Field;
use Yproximite\Api\Model\Inheritance\InheritanceStatuses;

class FieldSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Field::class);
    }

    function let()
    {
        $transData = ['value' => 'Required field'];

        $data = [
            'id'                 => '7',
            'token'              => 'required-field',
            'description'        => 'Some information about it',
            'translations'       => ['en' => $transData],
            'dataParent'         => '8',
            'createdAt'          => ['date' => '2011-05-19 20:46:21.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'updatedAt'          => ['date' => '2016-01-11 00:00:00.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'inheritance_status' => 'inherited',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(7);
        $this->getToken()->shouldReturn('required-field');
        $this->getDescription()->shouldReturn('Some information about it');
        $this->getTranslations()->shouldHaveCount(1);
        $this->getDataParentId()->shouldReturn(8);
        $this->getCreatedAt()->shouldBeLike(new \DateTime('2011-05-19 20:46:21'));
        $this->getUpdatedAt()->shouldBeLike(new \DateTime('2016-01-11 00:00:00'));
        $this->getInheritanceStatus()->shouldReturn(InheritanceStatuses::INHERITED);
    }
}
