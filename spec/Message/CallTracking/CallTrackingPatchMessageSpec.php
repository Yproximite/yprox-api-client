<?php

namespace spec\Yproximite\Api\Message\CallTracking;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\CallTracking\CallTracking;
use Yproximite\Api\Message\CallTracking\CallTrackingPatchMessage;

class CallTrackingPatchMessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CallTrackingPatchMessage::class);
    }

    function it_should_build()
    {
        $this->setName('Simple call');
        $this->setPhoneDid('+1 123 233 99 91');
        $this->setPhoneDestination('+1 921 339 44 77');
        $this->setCallerId(true);

        $data = [
            'callerId' => 1,
        ];

        $this->build()->shouldReturn($data);
    }

    function it_should_create_from_call_tracking(CallTracking $callTracking)
    {
        $callTracking->getId()->willReturn(1);
        $callTracking->getName()->willReturn('Simple call');
        $callTracking->getPhoneDid()->willReturn('+1 123 233 99 91');
        $callTracking->getPhoneDestination()->willReturn('+1 921 339 44 77');
        $callTracking->hasCallerId()->willReturn(true);

        $message = new CallTrackingPatchMessage();
        $message->setId(1);
        $message->setName('Simple call');
        $message->setPhoneDid('+1 123 233 99 91');
        $message->setPhoneDestination('+1 921 339 44 77');
        $message->setCallerId(true);

        $this::createFromCallTracking($callTracking)->shouldBeLike($message);
    }
}
