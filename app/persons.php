<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class persons extends Model
{
    protected $table='employess';
     protected $fillable=[
        'id','name','email','address','phone'
     ];
     public $timestamps = false;
}
