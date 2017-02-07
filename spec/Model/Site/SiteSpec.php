<?php

namespace spec\Yproximite\Api\Model\Site;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Site\Site;

class SiteSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Site::class);
    }

    function let()
    {
        $data = [
            'id'            => '3',
            'title'         => 'Hello world!',
            'host'          => 'hello-world.com',
            'company'       => '7',
            'contactEmail'  => 'echo@hello-world.com',
            'createdAt'     => ['date' => '2011-05-19 20:46:21.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'updatedAt'     => ['date' => '2016-01-11 00:00:00.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'theme'         => '9',
            'billingStatus' => 'direct',
            'type'          => 'site',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(3);
        $this->getTitle()->shouldReturn('Hello world!');
        $this->getHost()->shouldReturn('hello-world.com');
        $this->getCompanyId()->shouldReturn(7);
        $this->getContactEmail()->shouldReturn('echo@hello-world.com');
        $this->getCreatedAt()->shouldBeLike(new \DateTime('2011-05-19 20:46:21'));
        $this->getUpdatedAt()->shouldBeLike(new \DateTime('2016-01-11 00:00:00'));
        $this->getThemeId()->shouldReturn(9);
        $this->getBillingStatus()->shouldReturn(Site::BILLING_STATUS_DIRECT);
        $this->getType()->shouldReturn(Site::TYPE_SITE);
    }
}
