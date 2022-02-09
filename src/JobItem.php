<?php

namespace nimspy\Quiqup;

class JobItem
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $quantity;

    public function __construct(array $data = [])
    {
        if (isset($data['name'])) {
            $this->setName($data['name']);
        }
        if (isset($data['quantity'])) {
            $this->setQuantity(1);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}