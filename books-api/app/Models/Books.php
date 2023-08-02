<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //public $incrementing = false;
    protected $table = 'Books';
    protected $fillable=[
        'id','title','topic','items','cost'
    ];

    /*public static function find($number)
    {
    }*/
}
