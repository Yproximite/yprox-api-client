<?php

namespace spec\Yproximite\Api\Service;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Client\Client;
use Yproximite\Api\Model\Media\Media;
use Yproximite\Api\Factory\ModelFactory;
use Yproximite\Api\Service\MediaService;
use Yproximite\Api\Message\Media\MediaUploadMessage;
use Yproximite\Api\Message\Media\MediaDynamicUrlMessage;

class MediaServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MediaService::class);
    }

    function let(Client $client, ModelFactory $factory)
    {
        $this->beConstructedWith($client, $factory);
    }

    function it_should_get_media_dynamic_url(Client $client, MediaDynamicUrlMessage $message)
    {
        $message->getSiteId()->willReturn(1);
        $message->getId()->willReturn(2);
        $message->getFormat()->willReturn('Sw160');

        $method = 'GET';
        $path   = 'sites/1/media/2/dynamic_url/Sw160';

        $client->sendRequest($method, $path)->willReturn(['url' => 'bar']);
        $client->sendRequest($method, $path)->shouldBeCalled();

        $this->getMediaDynamicUrl($message)->shouldReturn('bar');
    }

    function it_should_upload_medias(
        Client $client,
        ModelFactory $factory,
        MediaUploadMessage $message
    ) {
        $method  = 'POST';
        $path    = 'sites/1/uploads/media';
        $body    = null;
        $headers = ['foo' => 'bar'];

        $message->getSiteId()->willReturn(1);
        $message->build()->willReturn($body);
        $message->buildHeaders()->willReturn($headers);
        $message->initBuilder()->shouldBeCalled();

        $client->sendRequest($method, $path, $body, $headers)->willReturn([]);
        $client->sendRequest($method, $path, $body, $headers)->shouldBeCalled();

        $factory->createMany(Media::class, [])->willReturn([]);

        $this->uploadMedias($message);
    }
}
