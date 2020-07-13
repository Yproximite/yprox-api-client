<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Company;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\Company\Company;

/**
 * Class CompanyPatchMessage
 */
class CompanyPatchMessage extends AbstractCompanyMessage
{
    use IdentityAwareMessageTrait;

    public static function createFromCompany(Company $company): self
    {
        $message = new self();
        $message->setId($company->getId());
        $message->setName($company->getName());
        $message->setParentId($company->getParentId());

        return $message;
    }
}
