<?php

namespace spec\Yproximite\Api\Util;

use PhpSpec\ObjectBehavior;
use Yproximite\Api\Exception\FileNotFoundException;
use Yproximite\Api\Util\UploadFile;

class UploadFileSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->beConstructedWith('foo');
        $this->shouldHaveType(UploadFile::class);
    }

    public function it_should_works_if_file_is_a_string()
    {
        $this->beConstructedWith(__DIR__.'/../fixtures/Yproximite.png');

        $this->getName()->shouldReturn('Yproximite.png');
        $this->getPath()->shouldReturn(__DIR__.'/../fixtures/Yproximite.png');
        $this->getContent()->shouldBeString();
    }

    public function it_should_works_if_file_is_an_array_but_without_filename()
    {
        $this->beConstructedWith(['path' => __DIR__.'/../fixtures/Yproximite.png']);

        $this->getName()->shouldReturn('Yproximite.png');
        $this->getPath()->shouldReturn(__DIR__.'/../fixtures/Yproximite.png');
        $this->getContent()->shouldBeString();
    }

    public function it_should_works_if_file_is_an_array()
    {
        $this->beConstructedWith(['path' => __DIR__.'/../fixtures/Yproximite.png', 'name' => 'Filename.png']);

        $this->getName()->shouldReturn('Filename.png');
        $this->getPath()->shouldReturn(__DIR__.'/../fixtures/Yproximite.png');
        $this->getContent()->shouldBeString();
    }

    public function it_should_fails_if_file_do_not_exists()
    {
        $this->beConstructedWith('file-that-do-not-exists.png');
        $this->shouldThrow(FileNotFoundException::class)->duringInstantiation();
    }
}
