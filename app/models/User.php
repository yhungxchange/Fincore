<?php

class User
{
    public $id;
    public $fullName;
    public $username;
    public $email;
    public $phone;
    public $passwordHash;
    public $status;

    public function __construct(
        $fullName,
        $username,
        $email,
        $phone,
        $passwordHash
    ) {
        $this->fullName = $fullName;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->passwordHash = $passwordHash;
        $this->status = "active";
    }

    public function getProfile()
    {
        return [
            "Full Name" => $this->fullName,
            "Username" => $this->username,
            "Email" => $this->email,
            "Phone" => $this->phone,
            "Status" => $this->status
        ];
    }
}
