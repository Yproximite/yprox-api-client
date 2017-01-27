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

    /**
     * @return int
     */
    public function getSiteId(): int
    {
        return $this->siteId;
    }

    /**
     * @param int $siteId
     */
    public function setSiteId(int $siteId)
    {
        $this->siteId = $siteId;
    }
}
