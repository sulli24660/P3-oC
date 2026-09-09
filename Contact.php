<?php
class Contact
{
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $phone_number;

    public function __construct(?int $id, ?string $name, ?string $email, ?string $phone_number = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

public function __toString(): string
    {
        return "- {$this->id} - {$this->name} - {$this->email} - {$this->phone_number}";
    }
}