<?php

declare(strict_types=1);

namespace Yproximite\Api\Service;

use Yproximite\Api\Message\Company\CompanyPatchMessage;
use Yproximite\Api\Message\Company\CompanyPostMessage;
use Yproximite\Api\Model\Company\Company;

/**
 * Class CompanyService
 */
class CompanyService extends AbstractService implements ServiceInterface
{
    public function postCompany(CompanyPostMessage $message): Company
    {
        $path = 'companies';
        $data = ['api_company' => $message->build()];

        $response = $this->getClient()->sendRequest('POST', $path, $data);

        /** @var Company $model */
        $model = $this->getModelFactory()->create(Company::class, $response);

        return $model;
    }

    public function patchCompany(CompanyPatchMessage $message): Company
    {
        $path = sprintf('companies/%d', $message->getId());
        $data = ['api_company' => $message->build()];

        $response = $this->getClient()->sendRequest('PATCH', $path, $data);

        /** @var Company $model */
        $model = $this->getModelFactory()->create(Company::class, $response);

        return $model;
    }
}
