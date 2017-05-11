<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Site;

/**
 * Class SitePostMessage
 */
class SitePostMessage extends AbstractSiteMessage
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'title'                 => $this->getTitle(),
            'dataParent'            => $this->getDataParentId(),
            'theme'                 => $this->getThemeId(),
            'contactEmail'          => $this->getContactEmail(),
            'host'                  => $this->getHost(),
            'defaultLocale'         => $this->getDefaultLocale(),
            'company'               => $this->getCompanyId(),
            'sendRegistrationEmail' => $this->isSendRegistrationEmail(),
            'zohoManager'           => $this->getZohoManager(),
            'zohoStatus'            => $this->getZohoStatus(),
            'billingStatus'         => $this->getBillingStatus(),
            'importRef'             => $this->getImportRef(),
        ];
    }
}
