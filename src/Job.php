<?php

namespace nimspy\Quiqup;

class Job
{
    /**
     * @var JobPickup
     */
    private $pickups;
    /**
     * @var JobDropoff
     */
    private $dropoffs;

    /**
     * @param JobPickup $pickup
     * @return Job
     */
    public function setPickups(JobPickup $pickup)
    {
        $this->pickups = $pickup;
        return $this;
    }

    /**
     * @param JobDropoff $dropoff
     * @return Job
     */
    public function setDropoffs(JobDropoff $dropoff)
    {
        $this->dropoffs = $dropoff;
        return $this;
    }

    /**
     * @return array
     */
    public function getJob()
    {
        return [
            "needs_return" => true,
            "transport_mode" => "scooter",
            "pickups" => [$this->getPickup()],
            "dropoffs" => [$this->getDropoff()],
        ];
    }

    /**
     * @return \stdClass
     */
    private function getPickup()
    {
        $obj = new \stdClass();

        $obj->contact_name = $this->pickups->getContact()->getContactName();
        $obj->contact_phone = $this->pickups->getContact()->getContactPhone();
        $obj->partner_order_id = $this->pickups->getPartnerOrderId();
        $obj->share_tracking = true;
        $obj->notes = $this->pickups->getNotes();
        $obj->location = $this->pickups->getLocationObject();
        $obj->items = [];

        foreach ($this->pickups->getItems() as $item) {
            $itemData = [
                'name' => $item->getName(),
                'quantity' => $item->getQuantity(),
            ];
            $obj->items[] = (object) $itemData;
        }

        return $obj;
    }

    /**
     * @return \stdClass
     */
    private function getDropoff()
    {
        $obj = new \stdClass();

        $obj->contact_name = $this->dropoffs->getContact()->getContactName();
        $obj->contact_phone = $this->dropoffs->getContact()->getContactPhone();
        $obj->share_tracking = true;
        $obj->notes = $this->dropoffs->getNotes();
        $obj->location = $this->dropoffs->getLocationObject();

        return $obj;
    }
}