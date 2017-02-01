<?php

namespace spec\Yproximite\Api\Model\Company;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Company\Company;

class CompanySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Company::class);
    }

    function let()
    {
        $data = [
            'id'          => '4',
            'companyName' => 'First company',
            'parent'      => '1',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(4);
        $this->getName()->shouldReturn('First company');
        $this->getParentId()->shouldReturn(1);
    }
}
