<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\TeamWorker;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\TeamWorker\TeamWorker;

/**
 * Class TeamWorkerPatchMessage
 */
class TeamWorkerPatchMessage extends AbstractTeamWorkerMessage
{
    use IdentityAwareMessageTrait;

    public static function createFromTeamWorker(TeamWorker $teamWorker): self
    {
        $message = new self();
        $message->setId($teamWorker->getId());
        $message->setLastName($teamWorker->getLastName());
        $message->setFirstName($teamWorker->getFirstName());

        return $message;
    }
}
