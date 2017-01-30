<?php

namespace spec\Yproximite\Api\Model\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Media\Media;
use Yproximite\Api\Model\Article\ArticleMedia;

class ArticleMediaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ArticleMedia::class);
    }

    function let()
    {
        $media = [
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

        $data = [
            'id'            => '10',
            'display_order' => '5',
            'media'         => $media,
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(10);
        $this->getDisplayOrder()->shouldReturn(5);
        $this->getMedia()->shouldBeAnInstanceOf(Media::class);
    }
}
