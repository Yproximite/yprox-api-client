<?php
declare(strict_types=1);

namespace Yproximite\Api\Message\Site;

use Yproximite\Api\Model\Site\Site;
use Yproximite\Api\Message\MessageInterface;

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

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getDataParentId(): int
    {
        return $this->dataParentId;
    }

    /**
     * @param int $dataParentId
     */
    public function setDataParentId(int $dataParentId)
    {
        $this->dataParentId = $dataParentId;
    }

    /**
     * @return int
     */
    public function getThemeId(): int
    {
        return $this->themeId;
    }

    /**
     * @param int $themeId
     */
    public function setThemeId(int $themeId)
    {
        $this->themeId = $themeId;
    }

    /**
     * @return null|string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * @param null|string $contactEmail
     */
    public function setContactEmail(string $contactEmail = null)
    {
        $this->contactEmail = $contactEmail;
    }

    /**
     * @return null|string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param null|string $host
     */
    public function setHost(string $host = null)
    {
        $this->host = $host;
    }

    /**
     * @return null|string
     */
    public function getDefaultLocale()
    {
        return $this->defaultLocale;
    }

    /**
     * @param null|string $defaultLocale
     */
    public function setDefaultLocale(string $defaultLocale = null)
    {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * @return int
     */
    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    /**
     * @param int $companyId
     */
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

    /**
     * @param bool|null $sendRegistrationEmail
     */
    public function setSendRegistrationEmail(bool $sendRegistrationEmail = null)
    {
        $this->sendRegistrationEmail = $sendRegistrationEmail;
    }

    /**
     * @return null|string
     */
    public function getZohoManager()
    {
        return $this->zohoManager;
    }

    /**
     * @param null|string $zohoManager
     */
    public function setZohoManager(string $zohoManager = null)
    {
        $this->zohoManager = $zohoManager;
    }

    /**
     * @return null|string
     */
    public function getZohoStatus()
    {
        return $this->zohoStatus;
    }

    /**
     * @param null|string $zohoStatus
     */
    public function setZohoStatus(string $zohoStatus = null)
    {
        $this->zohoStatus = $zohoStatus;
    }

    /**
     * @see Site::getBillingStatuses()
     *
     * @return null|string
     */
    public function getBillingStatus()
    {
        return $this->billingStatus;
    }

    /**
     * @param null|string $billingStatus
     */
    public function setBillingStatus(string $billingStatus = null)
    {
        $this->billingStatus = $billingStatus;
    }

    /**
     * @return null|string
     */
    public function getImportRef()
    {
        return $this->importRef;
    }

    /**
     * @param null|string $importRef
     */
    public function setImportRef(string $importRef = null)
    {
        $this->importRef = $importRef;
    }
}
