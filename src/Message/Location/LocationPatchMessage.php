<?php

declare(strict_types=1);

namespace Yproximite\Api\Message\Location;

use Yproximite\Api\Message\IdentityAwareMessageTrait;
use Yproximite\Api\Model\Location\Location;

/**
 * Class LocationPatchMessage
 */
class LocationPatchMessage extends AbstractLocationMessage
{
    use IdentityAwareMessageTrait;

    public static function createFromLocation(Location $location): self
    {
        $message = new self();
        $message->setId($location->getId());
        $message->setTel($location->getTel());
        $message->setFax($location->getFax());
        $message->setMail($location->getMail());
        $message->setAddress($location->getAddress());
        $message->setPostalCode($location->getPostalCode());
        $message->setTown($location->getTown());
        $message->setCountry($location->getCountry());
        $message->setDefaultLocation($location->isDefaultLocation());
        $message->setLatitude($location->getLatitude());
        $message->setLongitude($location->getLongitude());

        foreach ($location->getTranslations() as $translation) {
            $transMessage = LocationTranslationMessage::createFromLocationTranslation($translation);

            $message->addTranslation($transMessage);
        }

        return $message;
    }
}
