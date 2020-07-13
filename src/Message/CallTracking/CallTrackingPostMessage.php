<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\CallTracking;

/**
 * Class CallTrackingPostMessage
 */
class CallTrackingPostMessage extends AbstractCallTrackingMessage
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'name'             => $this->getName(),
            'phoneDid'         => $this->getPhoneDid(),
            'phoneDestination' => $this->getPhoneDestination(),
            'callerId'         => \intval($this->hasCallerId()),
        ];
    }
}
