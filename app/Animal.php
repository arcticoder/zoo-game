<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = array('title', 'health', 'state');
    protected $table = 'animal';
}
