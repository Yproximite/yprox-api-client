<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Model\Company\Company;
use Yproximite\Api\Service\CompanyService;
use Yproximite\Api\Message\Company\CompanyPostMessage;
use Yproximite\Api\Message\Company\CompanyPatchMessage;

class CompanyServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CompanyService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_post_company(
        Client $client,
        ModelFactory $factory,
        CompanyPostMessage $message,
        Company $company
    ) {
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'companies';
        $data   = ['api_company' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Company::class, [])->willReturn($company);

        $this->postCompany($message);
    }

    function it_should_patch_company(
        Client $client,
        ModelFactory $factory,
        CompanyPatchMessage $message,
        Company $company
    ) {
        $message->getId()->willReturn(2);
        $message->build()->willReturn([]);

        $method = 'PATCH';
        $path   = 'companies/2';
        $data   = ['api_company' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Company::class, [])->willReturn($company);

        $this->patchCompany($message);
    }
}
