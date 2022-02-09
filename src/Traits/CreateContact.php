<?php
namespace nimspy\Quiqup\Traits;

use nimspy\Quiqup\Contact;

trait CreateContact
{
    public function createContact($name, $phone)
    {
        $contact = new Contact([
            'contact_name' => $name,
            'contact_phone' => $phone,
        ]);

        return $this->setContact($contact);
    }
}