<?php

namespace spec\Yproximite\Api\Message\Site;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\Site\Site;
use Yproximite\Api\Message\Site\SitePostMessage;

class SitePostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SitePostMessage::class);
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
            'title'                 => 'Hello world!',
            'dataParent'            => 5,
            'theme'                 => 1,
            'contactEmail'          => 'hello@world.com',
            'host'                  => 'hello-world.com',
            'defaultLocale'         => 'en',
            'company'               => 1,
            'sendRegistrationEmail' => true,
            'zohoManager'           => 'Manager',
            'zohoStatus'            => 'Active',
            'billingStatus'         => 'direct',
            'importRef'             => '12345af',
        ];

        $this->build()->shouldReturn($data);
    }
}
