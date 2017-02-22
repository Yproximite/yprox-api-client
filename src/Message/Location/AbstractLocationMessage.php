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

    /**
     * @return string
     */
    public function getTel(): string
    {
        return $this->tel;
    }

    /**
     * @param string $tel
     */
    public function setTel(string $tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return null|string
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    /**
     * @param null|string $tel2
     */
    public function setTel2(string $tel2 = null)
    {
        $this->tel2 = $tel2;
    }

    /**
     * @return null|string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param null|string $fax
     */
    public function setFax(string $fax = null)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @param string $town
     */
    public function setTown(string $town)
    {
        $this->town = $town;
    }

    /**
     * @return null|string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param null|string $country
     */
    public function setCountry(string $country = null)
    {
        $this->country = $country;
    }

    /**
     * @return null|string
     */
    public function getAddressForGoogleMap()
    {
        return $this->addressForGoogleMap;
    }

    /**
     * @param null|string $addressForGoogleMap
     */
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

    /**
     * @param bool|null $defaultLocation
     */
    public function setDefaultLocation(bool $defaultLocation = null)
    {
        $this->defaultLocation = $defaultLocation;
    }

    /**
     * @return null|string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param null|string $latitude
     */
    public function setLatitude(string $latitude = null)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return null|string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param null|string $longitude
     */
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

    /**
     * @param LocationTranslationMessage $translation
     */
    public function addTranslation(LocationTranslationMessage $translation)
    {
        $this->translations[] = $translation;
    }

    /**
     * @param LocationTranslationMessage $translation
     */
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
