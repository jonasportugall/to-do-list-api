<?php

namespace App\DTOs;
use Spatie\DataTransferObject\DataTransferObject;

class LoginDTO extends DataTransferObject{
    public string $email;
    public string $password;
}