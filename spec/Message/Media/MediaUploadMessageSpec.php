<?php

namespace spec\Yproximite\Api\Message\Media;

use PhpSpec\ObjectBehavior;
use Http\Discovery\StreamFactoryDiscovery;
use Http\Message\MultipartStream\MultipartStreamBuilder;

use Yproximite\Api\Exception\LogicException;
use Yproximite\Api\Message\Media\MediaUploadMessage;
use Yproximite\Api\Message\Media\MediaUploadFileMessage;

class MediaUploadMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MediaUploadMessage::class);
    }

    function it_should_build()
    {
        $file = new MediaUploadFileMessage();
        $file->setFilename('File.txt');
        $file->setResource('contents');

        $this->addFile($file);
        $this->initBuilder('abcd');

        $streamFactory = StreamFactoryDiscovery::find();

        $builder = new MultipartStreamBuilder($streamFactory);
        $builder->setBoundary('abcd');
        $builder->addResource('api_upload_media[medias][0]', 'contents', ['filename' => 'File.txt']);

        $stream  = $builder->build();
        $headers = ['Content-Type' => sprintf('multipart/form-data; boundary="%s"', $builder->getBoundary())];

        $this->build()->__toString()->shouldReturn($stream->__toString());
        $this->buildHeaders()->shouldReturn($headers);
    }

    function it_should_trigger_exception_on_build()
    {
        $this->shouldThrow(LogicException::class)->during('build');
    }

    function it_should_trigger_exception_on_build_headers()
    {
        $this->shouldThrow(LogicException::class)->during('buildHeaders');
    }
}
