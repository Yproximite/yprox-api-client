<?php

namespace spec\Yproximite\Api\Model\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Article\Category;
use Yproximite\Api\Model\Inheritance\InheritanceStatuses;

class CategorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Category::class);
    }

    function let()
    {
        $translation = [
            'locale'      => 'en',
            'title'       => 'English translation',
            'description' => 'Big text',
        ];

        $data = [
            'id'                 => '3',
            'translations'       => ['en' => $translation],
            'enabled'            => 1,
            'dataParent'         => '11',
            'parentRootId'       => '123',
            'createdAt'          => ['date' => '2011-05-19 20:46:21.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'updatedAt'          => ['date' => '2016-01-11 00:00:00.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'inheritance_status' => 'none',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(3);
        $this->getTranslations()->shouldHaveCount(1);
        $this->isEnabled()->shouldReturn(true);
        $this->getDataParentId()->shouldReturn(11);
        $this->getParentRootId()->shouldReturn(123);
        $this->getCreatedAt()->shouldBeLike(new \DateTime('2011-05-19 20:46:21'));
        $this->getUpdatedAt()->shouldBeLike(new \DateTime('2016-01-11 00:00:00'));
        $this->getInheritanceStatus()->shouldReturn(InheritanceStatuses::NONE);
    }
}
