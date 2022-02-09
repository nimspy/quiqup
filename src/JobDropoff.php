<?php

namespace nimspy\Quiqup;

use nimspy\Quiqup\Traits\CreateContact;
use nimspy\Quiqup\Traits\CreateLocation;

class JobDropoff
{
    use CreateLocation;
    use CreateContact;

    /**
     * @var Contact
     */
    private $contact;
    /**
     * @var string
     */
    private $payment_mode = "pre_paid";
    /**
     * @var int
     */
    private $payment_amount = 0;

    /**
     * @var Location
     */
    private $location;

    /**
     * @var string
     */
    private $notes = '';

    /**
     * @return Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @param Contact $contact
     * @return JobDropoff
     */
    public function setContact(Contact $contact): JobDropoff
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMode(): string
    {
        return $this->payment_mode;
    }

    /**
     * @param string $payment_mode
     * @return JobDropoff
     */
    public function setPaymentMode(string $payment_mode): JobDropoff
    {
        $this->payment_mode = $payment_mode;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaymentAmount(): int
    {
        return $this->payment_amount;
    }

    /**
     * @param int $payment_amount
     * @return JobDropoff
     */
    public function setPaymentAmount(int $payment_amount): JobDropoff
    {
        $this->payment_amount = $payment_amount;
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
     * @return JobDropoff
     */
    public function setLocation(Location $location): JobDropoff
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @param string $notes
     * @return JobDropoff
     */
    public function setNotes(string $notes): JobDropoff
    {
        $this->notes = $notes;
        return $this;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }
}