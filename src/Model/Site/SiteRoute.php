<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Site;

use Yproximite\Api\Model\ModelInterface;

/**
 * Class SiteRoute
 */
class SiteRoute implements ModelInterface
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @var string
     */
    private $path;

    /**
     * SiteRoute constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->locale = (string) $data['locale'];
        $this->path   = (string) $data['path'];
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
