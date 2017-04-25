<?php

namespace spec\Yproximite\Api\Model\CallTracking;

use PhpSpec\ObjectBehavior;

use Yproximite\Api\Model\CallTracking\CallTracking;

class CallTrackingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CallTracking::class);
    }

    function let()
    {
        $data = [
            'id'               => '11',
            'name'             => 'Simple call',
            'phoneDid'         => '+1 343 553 22 33',
            'phoneDestination' => '+1 233 211 21 77',
            'callerId'         => 1,
        ];

        $this->beConstructedWith($data);
    }

    function it_should_be_hydrated()
    {
        $this->getId()->shouldReturn(11);
        $this->getName()->shouldReturn('Simple call');
        $this->getPhoneDid()->shouldReturn('+1 343 553 22 33');
        $this->getPhoneDestination()->shouldReturn('+1 233 211 21 77');
        $this->hasCallerId()->shouldReturn(true);
    }
}
