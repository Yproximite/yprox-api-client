<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\TeamWorker;

use Yproximite\Api\Model\TeamWorker\TeamWorker;
use Yproximite\Api\Message\IdentityAwareMessageTrait;

/**
 * Class TeamWorkerPatchMessage
 */
class TeamWorkerPatchMessage extends AbstractTeamWorkerMessage
{
    use IdentityAwareMessageTrait;

    /**
     * @param TeamWorker $teamWorker
     *
     * @return self
     */
    public static function createFromTeamWorker(TeamWorker $teamWorker): self
    {
        $message = new self();
        $message->setId($teamWorker->getId());
        $message->setLastName($teamWorker->getLastName());
        $message->setFirstName($teamWorker->getFirstName());

        return $message;
    }
}
