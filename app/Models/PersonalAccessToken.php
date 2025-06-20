<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasFactory;

    public $keyType = 'string';
    public $incrementing = false;

    public static function booted(){
        static::creating(function($model){
            $model->id = Str::uuid();
        });
    }
}
