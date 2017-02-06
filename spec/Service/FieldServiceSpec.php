<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Model\Field\Field;
use Yproximite\Api\Service\FieldService;
use Yproximite\Api\Message\Field\FieldListMessage;
use Yproximite\Api\Message\Field\FieldPostMessage;
use Yproximite\Api\Message\Field\FieldPatchMessage;
use Yproximite\Api\Message\Field\FieldOverrideMessage;

class FieldServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FieldService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_get_fields(
        Client $client,
        ModelFactory $factory,
        FieldListMessage $message
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'GET';
        $path   = 'sites/1/fields';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->createMany(Field::class, [])->willReturn([]);

        $this->getFields($message);
    }

    function it_should_post_field(
        Client $client,
        ModelFactory $factory,
        FieldPostMessage $message,
        Field $field
    ) {
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'POST';
        $path   = 'sites/1/fields';
        $data   = ['api_field' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Field::class, [])->willReturn($field);

        $this->postField($message);
    }

    function it_should_patch_field(
        Client $client,
        ModelFactory $factory,
        FieldPatchMessage $message,
        Field $field
    ) {
        $message->getId()->willReturn(2);
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'PATCH';
        $path   = 'sites/1/fields/2';
        $data   = ['api_field' => []];

        $client->sendRequest($method, $path, $data)->willReturn([]);
        $client->sendRequest($method, $path, $data)->shouldBeCalled();

        $factory->create(Field::class, [])->willReturn($field);

        $this->patchField($message);
    }

    function it_should_override_field(
        Client $client,
        ModelFactory $factory,
        FieldOverrideMessage $message,
        Field $field
    ) {
        $message->getId()->willReturn(5);
        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn([]);

        $method = 'GET';
        $path   = 'sites/1/fields/5/override';

        $client->sendRequest($method, $path)->willReturn([]);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $factory->create(Field::class, [])->willReturn($field);

        $this->overrideField($message);
    }
}
