<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verifying extends Model
{
    protected $table = 'verifyings';
    public $primarykey = 'id';
    public $timestamp = true;
}
