<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class chessModel extends Model
{   
    public $table='users';
    public $timestamps=false;
    protected $fillable = 
    [
        'name', 'password'
    ];
}
