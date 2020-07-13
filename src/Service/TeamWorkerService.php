<?php

declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Message\TeamWorker\TeamWorkerPatchMessage;
use Yproximite\Api\Message\TeamWorker\TeamWorkerPostMessage;
use Yproximite\Api\Model\TeamWorker\TeamWorker;

/**
 * Class TeamWorkerService
 */
class TeamWorkerService extends AbstractService implements ServiceInterface
{
    public function postTeamWorker(TeamWorkerPostMessage $message): TeamWorker
    {
        $path = sprintf('sites/%d/teams/workers', $message->getSiteId());
        $data = ['api_team_worker' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var TeamWorker $model */
        $model = $this->getModelFactory()->create(TeamWorker::class, $response);

        return $model;
    }

    public function patchTeamWorker(TeamWorkerPatchMessage $message): TeamWorker
    {
        $path = sprintf('sites/%d/teams/%d/worker', $message->getSiteId(), $message->getId());
        $data = ['api_team_worker' => $message->build()];

        $response = $this->getClient()->sendRequest('PATCH', $path, $data);

        /** @var TeamWorker $model */
        $model = $this->getModelFactory()->create(TeamWorker::class, $response);

        return $model;
    }
}
