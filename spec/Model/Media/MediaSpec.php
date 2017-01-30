<?php

namespace spec\Yproximite\Api\Model\Media;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Media\Media;

class MediaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Media::class);
    }

    function let()
    {
        $data = [
            'id'                      => '5',
            'filename'                => 'apple-box',
            'originalFilename'        => 'Apple Box',
            'originalFilenameSlugged' => 'App..Box.jpeg',
            'description'             => 'The biggest image',
            'title'                   => 'Apple Box Title',
            'visible'                 => 1,
            'created_at'              => '2011-05-19 20:46:21.000000',
            'updated_at'              => '2016-01-11 00:00:00.000000',
            'mime'                    => 'image/jpeg',
            'type'                    => 'image',
            'size'                    => 11345,
            'extension'               => 'jpg',
            'category_ids'            => [1, 2, 3],
            'link_url'                => 'http://site.com/media/original/apple-box.jpg',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(5);
        $this->getFilename()->shouldReturn('apple-box');
        $this->getOriginalFilename()->shouldReturn('Apple Box');
        $this->getOriginalFilenameSlugged()->shouldReturn('App..Box.jpeg');
        $this->getDescription()->shouldReturn('The biggest image');
        $this->getTitle()->shouldReturn('Apple Box Title');
        $this->isVisible()->shouldReturn(true);
        $this->getCreatedAt()->shouldBeLike(new \DateTime('2011-05-19 20:46:21'));
        $this->getUpdatedAt()->shouldBeLike(new \DateTime('2016-01-11 00:00:00'));
        $this->getMime()->shouldReturn('image/jpeg');
        $this->getType()->shouldReturn('image');
        $this->getSize()->shouldReturn(11345);
        $this->getExtension()->shouldReturn('jpg');
        $this->getCategoryIds()->shouldReturn([1, 2, 3]);
        $this->getLinkUrl()->shouldReturn('http://site.com/media/original/apple-box.jpg');
    }
}
