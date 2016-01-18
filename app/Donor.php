<?php

namespace App;

use App\SuperModel\SuperModel;
use Illuminate\Database\Eloquent\Model;

class Donor extends SuperModel
{
    //
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'governorate_id', 'blood_id'];


    public function governorate() {
        return $this->belongsTo('App\Governorate');
    }
    public function blood() {
        return $this->belongsTo('App\Blood');
    }

    public function setBloodIdAttribute($value) {
        $this->attributes['blood_id'] = \App\Blood::findId('blood', $value);
    }
    public function setGovernorateIdAttribute($value) {
        $this->attributes['governorate_id'] = \App\Governorate::findId('governorate', $value);
    }
}
