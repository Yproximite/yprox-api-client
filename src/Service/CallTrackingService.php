<?php

declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Message\CallTracking\CallTrackingPatchMessage;
use Yproximite\Api\Message\CallTracking\CallTrackingPostMessage;
use Yproximite\Api\Model\CallTracking\CallTracking;

/**
 * Class CallTrackingService
 */
class CallTrackingService extends AbstractService implements ServiceInterface
{
    public function postCallTracking(CallTrackingPostMessage $message): CallTracking
    {
        $path = sprintf('sites/%d/call_trackings', $message->getSiteId());
        $data = ['api_call_tracking' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var CallTracking $model */
        $model = $this->getModelFactory()->create(CallTracking::class, $response);

        return $model;
    }

    public function patchCallTracking(CallTrackingPatchMessage $message): CallTracking
    {
        $path = sprintf('sites/%d/call_trackings/update', $message->getSiteId());
        $data = ['api_call_tracking_edit' => $message->build()];

        $response = $this->getClient()->sendRequest('PATCH', $path, $data);

        /** @var CallTracking $model */
        $model = $this->getModelFactory()->create(CallTracking::class, $response);

        return $model;
    }
}
