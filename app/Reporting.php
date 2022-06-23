<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    protected $table = 'reportings';
    public $primarykey = 'id';
    public $timestamp = true;
}
