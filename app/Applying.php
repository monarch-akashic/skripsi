<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applying extends Model
{
    protected $table = 'applyings';
    public $primarykey = 'id';
    public $timestamp = true;

    public function getApplicantInfo(){
        return $this->belongsTo('App\User', 'applicant_id');
    }
}
