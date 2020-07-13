<?php

declare(strict_types=1);

namespace Yproximite\Api\Message;

/**
 * Trait SiteAwareMessageTrait
 */
trait SiteAwareMessageTrait
{
    /**
     * @var int
     */
    protected $siteId;

    public function getSiteId(): int
    {
        return $this->siteId;
    }

    public function setSiteId(int $siteId)
    {
        $this->siteId = $siteId;
    }
}
