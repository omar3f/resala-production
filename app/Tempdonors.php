<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempdonors extends Model
{
    //
    protected $fillable = [
      "first_name", "last_name".
        "email", "phone",
        "governorate_id", "blood_id",
        "confirm_code"
    ];
}
