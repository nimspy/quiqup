<?php

namespace nimspy\Quiqup;

class Contact
{
    /**
     * @var string
     */
    private $contact_name;
    /**
     * @var string
     */
    private $contact_phone;

    public function __construct(array $data = [])
    {
        $this->contact_name = $data['contact_name'] ?? '';
        $this->contact_phone = $data['contact_phone'] ?? '';
    }

    /**
     * @return string
     */
    public function getContactName(): string
    {
        return $this->contact_name;
    }

    /**
     * @param string $contact_name
     */
    public function setContactName(string $contact_name): void
    {
        $this->contact_name = $contact_name;
    }

    /**
     * @return string
     */
    public function getContactPhone(): string
    {
        return $this->contact_phone;
    }

    /**
     * @param string $contact_phone
     */
    public function setContactPhone(string $contact_phone): void
    {
        $this->contact_phone = $contact_phone;
    }
}