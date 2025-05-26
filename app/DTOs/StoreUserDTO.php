<?php

namespace App\DTOs;
use Spatie\DataTransferObject\DataTransferObject;

class StoreUserDTO extends DataTransferObject{
    public string $name;
    public string $email;
    public string $password;
}