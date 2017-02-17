<?php

namespace spec\Yproximite\Api\Message\CallTracking;

use PhpSpec\ObjectBehavior;
use Yproximite\Api\Message\CallTracking\CallTrackingPostMessage;

class CallTrackingPostMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CallTrackingPostMessage::class);
    }

    function it_should_build()
    {
        $this->setName('Simple call');
        $this->setPhoneDid('+1 123 233 99 91');
        $this->setPhoneDestination('+1 921 339 44 77');

        $data = [
            'name'             => 'Simple call',
            'phoneDid'         => '+1 123 233 99 91',
            'phoneDestination' => '+1 921 339 44 77',
        ];

        $this->build()->shouldReturn($data);
    }
}
