<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\User;

class Task extends Model
{
    protected $fillable = ['title','description','status','user_id'];

    public $incrementing = false;
    protected $keyType = 'string';

    public static function booted(){
        static::creating(function($model){
            $model->id = Str::uuid();
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}
