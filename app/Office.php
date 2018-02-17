<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = ['name'];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    public function required_staff_numbers()
    {
        return $this->hasMany(RequiredStaffNumber::class);
    }
}
