<?php

namespace spec\Yproximite\Api\Message\Company;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Message\Company\CompanyPostMessage;

class CompanyPostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CompanyPostMessage::class);
    }

    function it_should_build()
    {
        $this->setParentId(5);
        $this->setName('First company');

        $data = [
            'companyName' => 'First company',
            'parent'      => 5,
        ];

        $this->build()->shouldReturn($data);
    }
}
