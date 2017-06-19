<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\TeamWorker\TeamWorker;
use Yproximite\Api\Message\TeamWorker\TeamWorkerPatchMessage;
use Yproximite\Api\Message\TeamWorker\TeamWorkerPostMessage;

/**
 * Class TeamWorkerService
 */
class TeamWorkerService extends AbstractService implements ServiceInterface
{
    /**
     * @param TeamWorkerPostMessage $message
     *
     * @return TeamWorker
     */
    public function postTeamWorker(TeamWorkerPostMessage $message): TeamWorker
    {
        $path = sprintf('sites/%d/teams/workers', $message->getSiteId());
        $data = ['api_team_worker' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var TeamWorker $model */
        $model = $this->getModelFactory()->create(TeamWorker::class, $response);

        return $model;
    }

    /**
     * @param TeamWorkerPatchMessage $message
     *
     * @return TeamWorker
     */
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
