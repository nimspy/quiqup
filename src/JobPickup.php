<?php

namespace nimspy\Quiqup;

use nimspy\Quiqup\Traits\CreateContact;
use nimspy\Quiqup\Traits\CreateLocation;

class JobPickup
{
    use CreateContact;
    use CreateLocation;

    /**
     * @var Contact
     */
    private $contact;
    /**
     * @var string
     */
    private $partner_order_id;
    /**
     * @var string
     */
    private $notes;
    /**
     * @var Location
     */
    private $location;
    /**
     * @var array
     */
    private $items = [];

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return JobPickup
     */
    public function setContact(Contact $contact): JobPickup
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return string
     */
    public function getPartnerOrderId(): string
    {
        return $this->partner_order_id;
    }

    /**
     * @param string $partner_order_id
     * @return JobPickup
     */
    public function setPartnerOrderId(string $partner_order_id): JobPickup
    {
        $this->partner_order_id = $partner_order_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     * @return JobPickup
     */
    public function setNotes(string $notes): JobPickup
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     * @return JobPickup
     */
    public function setLocation(Location $location): JobPickup
    {
        $this->location = $location;
        return $this;
    }

    public function addItem(JobItem $item): JobPickup
    {
        $this->items[] = $item;
        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function createItem($name, $quantity = 1)
    {
        $item = new JobItem([
            'name' => $name,
            'quantity' => $quantity,
        ]);
        return $this->addItem($item);
    }
}