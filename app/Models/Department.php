<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // define the relation ship from deprtment to staff.
    public function staff(){
        return $this->hasOne(Staff::class);
    }

    public function getCreatedAtAttribute($value){
        return date('d/M/Y h:i A', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('d/M/Y h:i A', strtotime($value));
    }
}
