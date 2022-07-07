<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    protected $table = 'reportings';
    public $primarykey = 'id';
    public $timestamp = true;

    public function getApplicantInfo(){
        return $this->belongsTo('App\User', 'applicant_id');
    }
}
