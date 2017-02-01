<?php

namespace spec\Yproximite\Api\Message\Company;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Company\Company;
use Yproximite\Api\Message\Company\CompanyPatchMessage;

class CompanyPatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CompanyPatchMessage::class);
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

    function it_should_create_from_company(Company $company)
    {
        $company->getId()->willReturn(1);
        $company->getName()->willReturn('First company');
        $company->getParentId()->willReturn(5);

        $message = new CompanyPatchMessage();
        $message->setId(1);
        $message->setName('First company');
        $message->setParentId(5);

        $this::createFromCompany($company)->shouldBeLike($message);
    }
}
