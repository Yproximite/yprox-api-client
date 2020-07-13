<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Site;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\Site\Site;

/**
 * Class SitePatchMessage
 */
class SitePatchMessage extends AbstractSiteMessage
{
    use IdentityAwareMessageTrait;

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'host' => $this->getHost(),
        ];
    }

    public static function createFromSite(Site $site): self
    {
        $message = new self();
        $message->setId($site->getId());
        $message->setHost($site->getHost());
        $message->setBillingStatus($site->getBillingStatus());
        $message->setContactEmail($site->getContactEmail());
        $message->setCompanyId($site->getCompanyId());
        $message->setThemeId($site->getThemeId());
        $message->setTitle($site->getTitle());

        return $message;
    }
}
