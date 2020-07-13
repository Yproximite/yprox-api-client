<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Site;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Model\Site\Site;

/**
 * Class AbstractSiteMessage
 */
abstract class AbstractSiteMessage implements MessageInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $dataParentId;

    /**
     * @var int
     */
    private $themeId;

    /**
     * @var string|null
     */
    private $contactEmail;

    /**
     * @var string|null
     */
    private $host;

    /**
     * @var string|null
     */
    private $defaultLocale;

    /**
     * @var int
     */
    private $companyId;

    /**
     * @var bool|null
     */
    private $sendRegistrationEmail;

    /**
     * @var string|null
     */
    private $zohoManager;

    /**
     * @var string|null
     */
    private $zohoStatus;

    /**
     * @var string|null
     */
    private $billingStatus;

    /**
     * @var string|null
     */
    private $importRef;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDataParentId(): int
    {
        return $this->dataParentId;
    }

    public function setDataParentId(int $dataParentId)
    {
        $this->dataParentId = $dataParentId;
    }

    public function getThemeId(): int
    {
        return $this->themeId;
    }

    public function setThemeId(int $themeId)
    {
        $this->themeId = $themeId;
    }

    /**
     * @return string|null
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail = null)
    {
        $this->contactEmail = $contactEmail;
    }

    /**
     * @return string|null
     */
    public function getHost()
    {
        return $this->host;
    }

    public function setHost(string $host = null)
    {
        $this->host = $host;
    }

    /**
     * @return string|null
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    public function setDefaultLocale(string $defaultLocale = null)
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * @return bool|null
     */
    public function isSendRegistrationEmail()
    {
        return $this->sendRegistrationEmail;
    }

    public function setSendRegistrationEmail(bool $sendRegistrationEmail = null)
    {
        $this->sendRegistrationEmail = $sendRegistrationEmail;
    }

    /**
     * @return string|null
     */
    public function getZohoManager()
    {
        return $this->zohoManager;
    }

    public function setZohoManager(string $zohoManager = null)
    {
        $this->zohoManager = $zohoManager;
    }

    /**
     * @return string|null
     */
    public function getZohoStatus()
    {
        return $this->zohoStatus;
    }

    public function setZohoStatus(string $zohoStatus = null)
    {
        $this->zohoStatus = $zohoStatus;
    }

    /**
     * @see Site::getBillingStatuses()
     *
     * @return string|null
     */
    public function getBillingStatus()
    {
        return $this->billingStatus;
    }

    public function setBillingStatus(string $billingStatus = null)
    {
        $this->billingStatus = $billingStatus;
    }

    /**
     * @return string|null
     */
    public function getImportRef()
    {
        return $this->importRef;
    }

    public function setImportRef(string $importRef = null)
    {
        $this->importRef = $importRef;
    }
}
