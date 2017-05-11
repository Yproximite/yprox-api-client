<?php

namespace spec\Yproximite\Api\Message\Site;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Site\Site;
use Yproximite\Api\Message\Site\SitePatchMessage;

class SitePatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SitePatchMessage::class);
    }

    function it_should_build()
    {
        $this->setTitle('Hello world!');
        $this->setDataParentId(5);
        $this->setThemeId(1);
        $this->setContactEmail('hello@world.com');
        $this->setHost('hello-world.com');
        $this->setDefaultLocale('en');
        $this->setCompanyId(1);
        $this->setSendRegistrationEmail(true);
        $this->setZohoManager('Manager');
        $this->setZohoStatus('Active');
        $this->setBillingStatus(Site::BILLING_STATUS_DIRECT);
        $this->setImportRef('12345af');

        $data = [
            'host' => 'hello-world.com',
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_site(Site$site)
    {
        $site->getId()->willReturn(1);
        $site->getHost()->willReturn('test.fr');
        $site->getBillingStatus()->willReturn('test');
        $site->getContactEmail()->willReturn('test@test.fr');
        $site->getCompanyId()->willreturn(42);
        $site->getThemeId()->willReturn(12);
        $site->getTitle()->willreturn('Test');

        $message = new SitePatchMessage();
        $message->setId(1);
        $message->setHost('test.fr');
        $message->setBillingStatus('test');
        $message->setContactEmail('test@test.fr');
        $message->setCompanyId(42);
        $message->setThemeId(12);
        $message->setTitle('Test');

        $this::createFromSite($site)->shouldBeLike($message);
    }
}
