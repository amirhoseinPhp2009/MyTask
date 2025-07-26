<?php

namespace App\DTO;

class UserDTO {

    public static function getDataUser($requested): array
    {
        return [
            "country_id" => $requested['country_id'],
            "first_name" => $requested['first_name'],
            "last_name" => $requested['last_name'],
            "phone" => $requested['phone'],
            "email" => $requested['email'],
        ];
    }

}
