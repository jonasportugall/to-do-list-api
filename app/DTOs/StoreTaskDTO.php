<?php

namespace App\DTOs;
use Spatie\DataTransferObject\DataTransferObject;

class StoreTaskDTO extends DataTransferObject{
    public string $title;
    public string $description;
}