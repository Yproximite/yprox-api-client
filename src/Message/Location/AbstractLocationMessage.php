<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Location;

use Yproximite\Api\Message\MessageInterface;
use Yproximite\Api\Message\SiteAwareMessageTrait;
use Yproximite\Api\Util\Helper;

/**
 * Class AbstractLocationMessage
 */
abstract class AbstractLocationMessage implements MessageInterface
{
    use SiteAwareMessageTrait;

    /**
     * @var string
     */
    private $tel;

    /**
     * @var string|null
     */
    private $tel2;

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
     * @var string|null
     */
    private $country;

    /**
     * @var string|null
     */
    private $addressForGoogleMap;

    /**
     * @var bool|null
     */
    private $defaultLocation;

    /**
     * @var string|null
     */
    private $latitude;

    /**
     * @var string|null
     */
    private $longitude;

    /**
     * @var LocationTranslationMessage[]
     */
    private $translations = [];

    public function getTel(): string
    {
        return $this->tel;
    }

    public function setTel(string $tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return string|null
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    public function setTel2(string $tel2 = null)
    {
        $this->tel2 = $tel2;
    }

    /**
     * @return string|null
     */
    public function getFax()
    {
        return $this->fax;
    }

    public function setFax(string $fax = null)
    {
        $this->fax = $fax;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function getTown(): string
    {
        return $this->town;
    }

    public function setTown(string $town)
    {
        $this->town = $town;
    }

    /**
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry(string $country = null)
    {
        $this->country = $country;
    }

    /**
     * @return string|null
     */
    public function getAddressForGoogleMap()
    {
        return $this->addressForGoogleMap;
    }

    public function setAddressForGoogleMap(string $addressForGoogleMap = null)
    {
        $this->addressForGoogleMap = $addressForGoogleMap;
    }

    /**
     * @return bool|null
     */
    public function isDefaultLocation()
    {
        return $this->defaultLocation;
    }

    public function setDefaultLocation(bool $defaultLocation = null)
    {
        $this->defaultLocation = $defaultLocation;
    }

    /**
     * @return string|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude = null)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude = null)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return LocationTranslationMessage[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function addTranslation(LocationTranslationMessage $translation)
    {
        $this->translations[] = $translation;
    }

    public function removeTranslation(LocationTranslationMessage $translation)
    {
        array_splice($this->translations, array_search($translation, $this->translations), 1);
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return [
            'tel'                 => $this->getTel(),
            'tel2'                => $this->getTel2(),
            'fax'                 => $this->getFax(),
            'mail'                => $this->getMail(),
            'address'             => $this->getAddress(),
            'postalCode'          => $this->getPostalCode(),
            'town'                => $this->getTown(),
            'country'             => $this->getCountry(),
            'addressForGoogleMap' => $this->getAddressForGoogleMap(),
            'defaultLocation'     => $this->isDefaultLocation(),
            'latitude'            => $this->getLatitude(),
            'longitude'           => $this->getLongitude(),
            'translations'        => Helper::buildMessages($this->getTranslations(), 'locale'),
        ];
    }
}
