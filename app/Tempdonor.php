<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SuperModel\SuperModel;

class Tempdonor extends SuperModel
{
    //
    protected $fillable = [
        "first_name", "last_name",
        "email", "phone",
        "governorate_id", "blood_id",
        "confirm_code"
    ];
    public function governorate() {
        return $this->belongsTo('App\Governorate');
    }
    public function blood() {
        return $this->belongsTo('App\Blood');
    }

//    public function setBloodIdAttribute($value) {
//        $this->attributes['blood_id'] = \App\Blood::findId('blood', $value);
//    }
//    public function setGovernorateIdAttribute($value) {
//        $this->attributes['governorate_id'] = \App\Governorate::findId('governorate', $value);
//    }
    public function scopeConfCodeId($query, $confirm_code, $id) {
        return $query->where('confirm_code', $confirm_code)->where('id', $id);
    }
}
