<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Company;

use Yproximite\Api\Model\Company\Company;
use Yproximite\Api\Message\IdentityAwareMessageTrait;

/**
 * Class CompanyPatchMessage
 */
class CompanyPatchMessage extends CompanyMessage
{
    use IdentityAwareMessageTrait;

    /**
     * @param Company $company
     *
     * @return self
     */
    public static function createFromCompany(Company $company): self
    {
        $message = new CompanyPatchMessage();
        $message->setId($company->getId());
        $message->setName($company->getName());
        $message->setParentId($company->getParentId());

        return $message;
    }
}
