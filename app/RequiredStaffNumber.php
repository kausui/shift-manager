<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequiredStaffNumber extends Model
{
    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
