<?php

namespace App\Services;

class SelectService
{
    public function select(string $informacao) : bool
    {
        if(! $this->isValidDataToSelect($informacao)) {
            return false;
        }
        //insert data on database
        return true;
    }

    private function isValidDataToSelect(string $informacao)
    {
        $validData = [
            'userName',
            'zipCode',
            'phoneNumber',
            'email'
        ];

        return in_array($informacao, $validData);
    }
}