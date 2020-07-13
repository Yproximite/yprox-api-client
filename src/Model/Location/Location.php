<?php

declare(strict_types=1);

namespace Yproximite\Api\Model\Location;

use Yproximite\Api\Model\Inheritance\InheritanceStatuses;
use Yproximite\Api\Model\ModelInterface;

/**
 * Class Location
 */
class Location implements ModelInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var string|null
     */
    private $fax;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $town;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var string
     */
    private $country;

    /**
     * @var bool
     */
    private $defaultLocation;

    /**
     * @var int|null
     */
    private $dataParentId;

    /**
     * @var LocationTranslation[]
     */
    private $translations;

    /**
     * @var string
     */
    private $inheritanceStatus;

    /**
     * Location constructor.
     */
    public function __construct(array $data)
    {
        $translations = array_map(function (array $data, string $locale) {
            return new LocationTranslation($data + compact('locale'));
        }, array_values($data['translations']), array_keys($data['translations']));

        $this->id                = (int) $data['id'];
        $this->tel               = (string) $data['tel'];
        $this->fax               = !empty($data['fax']) ? (string) $data['fax'] : null;
        $this->mail              = (string) $data['mail'];
        $this->address           = (string) $data['address'];
        $this->postalCode        = (string) $data['postalCode'];
        $this->town              = (string) $data['town'];
        $this->latitude          = (string) $data['latitude'];
        $this->longitude         = (string) $data['longitude'];
        $this->country           = (string) $data['country'];
        $this->defaultLocation   = (bool) $data['defaultLocation'];
        $this->dataParentId      = !empty($data['dataParent']) ? (int) $data['dataParent'] : null;
        $this->translations      = $translations;
        $this->inheritanceStatus = (string) $data['inheritance_status'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTel(): string
    {
        return $this->tel;
    }

    /**
     * @return string|null
     */
    public function getFax()
    {
        return $this->fax;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getTown(): string
    {
        return $this->town;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function isDefaultLocation(): bool
    {
        return $this->defaultLocation;
    }

    /**
     * @return int|null
     */
    public function getDataParentId()
    {
        return $this->dataParentId;
    }

    /**
     * @return LocationTranslation[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @see InheritanceStatuses::getValues()
     */
    public function getInheritanceStatus(): string
    {
        return $this->inheritanceStatus;
    }
}
