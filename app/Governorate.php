<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    //
    public $timestamps = False;

    public function donors() {
        return $this->hasMany('App\Donor');
    }
    public function tempdonors() {
        return $this->hasMany('App\Tempdonor');
    }
    public function scopeFindId($query, $column ,$governorate) {
        return $query->where($column, '=', $governorate)->first()->id;
    }
}
