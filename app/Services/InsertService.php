<?php

namespace App\Services;

class InsertService
{
    private array $data;

    public function __construct(
        array $data
    )
    {
        $this->data = $data;
    }

    public function insert() : bool
    {
        if(! $this->isValidDataToInsert()) {
            return false;
        }
        return true;
    }

    private function isValidDataToInsert() : bool
    {
        if(! isset($this->data['userName']) || ! $this->isValidUserName($this->data['userName']))
            return false;
        if(! isset($this->data['zipCode']) || ! $this->isValidZipCode($this->data['zipCode']))
            return false;
        if(! isset($this->data['phoneNumber']) || ! $this->isValidPhoneNumber($this->data['phoneNumber']))
            return false;
        if(! isset($this->data['email']) || ! $this->isValidEmail($this->data['email']))
            return false;
        if(! isset($this->data['password']) || ! $this->isValidPassword($this->data['password']))
            return false;
        return true;
    }

    private function isValidUserName($userName) : bool
    {
        if(! is_string($userName)) return false;
        if(strlen($userName) > 255) return false;
        return true;
    }

    private function isValidEmail($email) : bool
    {
        if(! is_string($email)) return false;
        if(strlen($email) > 255) return false;
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }

    private function isValidZipCode($zipCode) : bool
    {
        if(! is_string($zipCode)) return false;
        if(strlen($zipCode) != 8) return false;
        return true;
    }

    private function isValidPhoneNumber($phoneNumber) : bool
    {
        if(! is_string($phoneNumber)) return false;
        if(strlen($phoneNumber) > 11) return false;
        if(strlen($phoneNumber) < 10) return false;
        return true;
    }

    private function isValidPassword($password) : bool
    {
        if(! is_string($password)) return false;
        if(strlen($password) < 8) return false;
        if(strlen($password) > 255) return false;
        if(! is_numeric(filter_var($password, FILTER_SANITIZE_NUMBER_INT))) return false;
        if(! preg_match("/[a-z]/i", $password)) return false;
        return true;
    }
}