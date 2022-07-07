<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    public $primarykey = 'id';
    public $timestamp = true;

    public function getCompanyInfo(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
