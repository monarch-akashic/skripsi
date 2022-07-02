<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    protected $table = 'portofolios';
    public $primarykey = 'id';
    public $timestamp = true;
    protected $casts = [
        'education' => 'array',
        'experience' => 'array',
        'skills' => 'array',
    ];
}
