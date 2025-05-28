<?php

namespace App\DTOs;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateTaskStatusDTO extends DataTransferObject{
    public string $status;
}