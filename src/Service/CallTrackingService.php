<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\CallTracking\CallTracking;
use Yproximite\Api\Message\CallTracking\CallTrackingPatchMessage;
use Yproximite\Api\Message\CallTracking\CallTrackingPostMessage;

/**
 * Class CallTrackingService
 */
class CallTrackingService extends AbstractService implements ServiceInterface
{
    /**
     * @param CallTrackingPostMessage $message
     *
     * @return CallTracking
     */
    public function postCallTracking(CallTrackingPostMessage $message): CallTracking
    {
        $path = sprintf('sites/%d/call_trackings', $message->getSiteId());
        $data = ['api_call_tracking' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var CallTracking $model */
        $model = $this->getModelFactory()->create(CallTracking::class, $response);

        return $model;
    }

    /**
     * @param CallTrackingPatchMessage $message
     *
     * @return CallTracking
     */
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
