<?php
declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Model\User\User;
use Yproximite\Api\Message\User\UserPostMessage;
use Yproximite\Api\Message\User\UserPatchMessage;

/**
 * Class UserService
 */
final class UserService extends AbstractService implements ServiceInterface
{
    /**
     * @param UserPostMessage $message
     *
     * @return User
     */
    public function postUser(UserPostMessage $message): User
    {
        $path = sprintf('companies/%d/users', $message->getCompanyId());
        $data = ['api_user' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var User $model */
        $model = $this->getModelFactory()->create(User::class, $response);

        return $model;
    }

    /**
     * @param UserPatchMessage $message
     *
     * @return User
     */
    public function patchUser(UserPatchMessage $message): User
    {
        $path = sprintf('companies/%d/users/%d', $message->getCompanyId(), $message->getId());
        $data = ['api_user' => $message->build()];

        $response = $this->getClient()->sendRequest('PATCH', $path, $data);

        /** @var User $model */
        $model = $this->getModelFactory()->create(User::class, $response);

        return $model;
    }
}
