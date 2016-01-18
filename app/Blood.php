<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blood extends Model
{
    //
    public $timestamps = False;
    public function donors() {
        return $this->hasMany('App\Donor');
    }
    public function tempdonors() {
        return $this->hasMany('App\Tempdonor');
    }
    public function scopeFindId($query, $column, $blood) {
        return $query->where($column, '=', $blood)->first()->id;
    }
}
