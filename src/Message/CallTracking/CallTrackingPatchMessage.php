<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\CallTracking;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\CallTracking\CallTracking;

/**
 * Class CallTrackingPatchMessage
 */
class CallTrackingPatchMessage extends AbstractCallTrackingMessage
{
    use IdentityAwareMessageTrait;

    /**
     * @param CallTracking $callTracking
     *
     * @return self
     */
    public static function createFromCallTracking(CallTracking $callTracking): self
    {
        $message = new self();
        $message->setId($callTracking->getId());
        $message->setName($callTracking->getName());
        $message->setPhoneDestination($callTracking->getPhoneDestination());
        $message->setPhoneDid($callTracking->getPhoneDid());
        $message->setCallerId($callTracking->hasCallerId());

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'callerId' => intval($this->hasCallerId()),
        ];
    }
}
