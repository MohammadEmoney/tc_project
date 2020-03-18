<?php

namespace App\Interfaces;

interface PhoneNumber {

    /**
     * Check the first 3 digit of the given phone number and
     * Declare the type of it.
     *
     * @param string $phone_number
     * @return string
     */
    public function phoneType(String $phone_number): void;
}
