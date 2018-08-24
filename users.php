<?php
class User
{

    public $accounts = [
        ["name" => "John Doe", "email" => "john.doe@example.com"],
        ["name" => "John Peter", "email" => "peter.doe@example.com"]
    ];

    public function getAllUser()
    {
        return $this->accounts;
    }
}
    
