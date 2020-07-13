<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\Site;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class Site
 */
class Site implements ModelInterface
{
    const BILLING_STATUS_TEST                 = 'test';
    const BILLING_STATUS_TRIAL                = 'trial';
    const BILLING_STATUS_FREE                 = 'free';
    const BILLING_STATUS_PARTNER              = 'partner';
    const BILLING_STATUS_DIRECT               = 'direct';
    const BILLING_STATUS_IN_DEVELOPMENT       = 'in-development';
    const BILLING_STATUS_WAITING_SUBSCRIPTION = 'waiting-subscription';
    const BILLING_STATUS_ERROR                = 'error';
    const BILLING_STATUS_CANCELED             = 'canceled';

    const TYPE_ROOT         = 'root';
    const TYPE_SITE         = 'site';
    const TYPE_PLATFORM     = 'platform';
    const TYPE_SUB_PLATFORM = 'sub-platform';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int|null
     */
    private $companyId;

    /**
     * @var string|null
     */
    private $contactEmail;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var int|null
     */
    private $themeId;

    /**
     * @var string
     */
    private $billingStatus;

    /**
     * @var string
     */
    private $type;

    /**
     * @return string[]
     */
    public static function getBillingStatuses(): array
    {
        return [
            self::BILLING_STATUS_TEST,
            self::BILLING_STATUS_TRIAL,
            self::BILLING_STATUS_FREE,
            self::BILLING_STATUS_PARTNER,
            self::BILLING_STATUS_DIRECT,
            self::BILLING_STATUS_IN_DEVELOPMENT,
            self::BILLING_STATUS_WAITING_SUBSCRIPTION,
            self::BILLING_STATUS_ERROR,
            self::BILLING_STATUS_CANCELED,
        ];
    }

    /**
     * @return string[]
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_ROOT,
            self::TYPE_SITE,
            self::TYPE_PLATFORM,
            self::TYPE_SUB_PLATFORM,
        ];
    }

    /**
     * Site constructor.
     */
    public function __construct(array $data)
    {
        $this->id            = (int) $data['id'];
        $this->title         = (string) $data['title'];
        $this->host          = (string) $data['host'];
        $this->companyId     = !empty($data['company']) ? (int) $data['company'] : null;
        $this->contactEmail  = (string) $data['contactEmail'];
        $this->createdAt     = new \DateTime($data['createdAt']['date']);
        $this->updatedAt     = new \DateTime($data['updatedAt']['date']);
        $this->themeId       = !empty($data['theme']) ? (int) $data['theme'] : null;
        $this->billingStatus = (string) $data['billingStatus'];
        $this->type          = (string) $data['type'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int|null
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return string|null
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @return int|null
     */
    public function getThemeId()
    {
        return $this->themeId;
    }

    /**
     * @see Site::getBillingStatuses()
     */
    public function getBillingStatus(): string
    {
        return $this->billingStatus;
    }

    /**
     * @see Site::getTypes()
     */
    public function getType(): string
    {
        return $this->type;
    }
}
