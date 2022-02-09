<?php

namespace nimspy\Quiqup;

class Location
{
    /**
     * @var string
     */
    private $address1;
    /**
     * @var string
     */
    private $address2;
    /**
     * @var array
     */
    private $coords;
    /**
     * @var string
     */
    private $country = "UAE";
    /**
     * @var string
     */
    private $town = "Dubai";

    public function __construct(array $data = [])
    {
        $this->address1 = $data['address1'] ?? '';
        $this->address2 = $data['address2'] ?? '';
        if (is_array($data['coords']) && !empty($data['coords'])) {
            $this->coords = $data['coords'];
        }
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1(string $address1): void
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2(string $address2): void
    {
        $this->address2 = $address2;
    }

    /**
     * @return array
     */
    public function getCoords(): array
    {
        return $this->coords;
    }

    /**
     * @param array $coords
     */
    public function setCoords(array $coords): void
    {
        $this->coords = $coords;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
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
    public function setTown(string $town): void
    {
        $this->town = $town;
    }
}