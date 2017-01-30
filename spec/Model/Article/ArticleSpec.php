<?php

namespace spec\Yproximite\Api\Model\Article;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Article\Article;
use Yproximite\Api\Model\Inheritance\InheritanceStatuses;

class ArticleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Article::class);
    }

    function let()
    {
        $translation = [
            'locale' => 'en',
            'title'  => 'English translation',
            'body'   => 'Big text',
            'slug'   => 'en-translation',
        ];

        $categoryTranslation = [
            'locale'      => 'en',
            'title'       => 'English category translation',
            'description' => 'Big category text',
        ];

        $category = [
            'id'                 => '3',
            'translations'       => ['en' => $categoryTranslation],
            'enabled'            => 1,
            'dataParent'         => '11',
            'createdAt'          => ['date' => '2011-05-19 20:46:21.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'updatedAt'          => ['date' => '2016-01-11 00:00:00.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'inheritance_status' => 'none',
        ];

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

        $articleMedia = [
            'id'            => '10',
            'display_order' => '5',
            'media'         => $media,
        ];

        $data = [
            'id'                    => '7',
            'translations'          => ['en' => $translation],
            'categories'            => [$category],
            'medias'                => [$articleMedia],
            'media_limit'           => '9',
            'status'                => 'published',
            'display_print_button'  => 1,
            'display_print_address' => 0,
            'with_return_button'    => 1,
            'show_creation_date'    => 1,
            'show_image_caption'    => 0,
            'auto_play_slider'      => 1,
            'routes'                => ['en' => 'simple-route-path'],
            'share_on_facebook'     => 1,
            'display_order'         => '5',
            'dataParent'            => '89',
            'createdAt'             => ['date' => '2011-05-19 20:46:21.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'updatedAt'             => ['date' => '2016-01-11 00:00:00.000000', 'timezone_type' => 3, 'timezone' => 'UTC'],
            'inheritance_status'    => 'inherited',
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(7);
        $this->getTranslations()->shouldHaveCount(1);
        $this->getCategories()->shouldHaveCount(1);
        $this->getMedias()->shouldHaveCount(1);
        $this->getMediaLimit()->shouldReturn(9);
        $this->getStatus()->shouldReturn(Article::STATUS_PUBLISHED);
        $this->isDisplayPrintButton()->shouldReturn(true);
        $this->isDisplayPrintAddress()->shouldReturn(false);
        $this->isWithReturnButton()->shouldReturn(true);
        $this->isShowCreationDate()->shouldReturn(true);
        $this->isShowImageCaption()->shouldReturn(false);
        $this->isAutoPlaySlider()->shouldReturn(true);
        $this->getRoutes()->shouldHaveCount(1);
        $this->isShareOnFacebook()->shouldReturn(true);
        $this->getDisplayOrder()->shouldReturn(5);
        $this->getDataParentId()->shouldReturn(89);
        $this->getCreatedAt()->shouldBeLike(new \DateTime('2011-05-19 20:46:21'));
        $this->getUpdatedAt()->shouldBeLike(new \DateTime('2016-01-11 00:00:00'));
        $this->getInheritanceStatus()->shouldReturn(InheritanceStatuses::INHERITED);
    }
}
