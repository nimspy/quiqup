<?php
namespace nimspy\Quiqup\Traits;

use nimspy\Quiqup\Location;

trait CreateLocation
{
    public function createLocation($address1, $address2, $coords)
    {
        $location = new Location([
            'address1' => $address1,
            'address2' => $address2,
            'coords' => $coords,
        ]);
        return $this->setLocation($location);
    }

    public function getLocationObject()
    {
        $location = $this->location;
        $obj = new \stdClass();
        $obj->address1 = $location->getAddress1();
        $obj->address2 = $location->getAddress2();
        $obj->coords = $location->getCoords();
        $obj->country = $location->getCountry();
        $obj->town = $location->getTown();

        return $obj;
    }
}