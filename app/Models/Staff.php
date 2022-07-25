<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    public function getCreatedAtAttribute($value){
        return date('d/M/Y', strtotime($value));
    }

    public function getUpdatedAtAttribute($value){
        return date('d/M/Y', strtotime($value));
    }

    // define inverse relationship from staff to department.
    public function department(){
        // If we want to use custome name for foreinkey so defined with the second argument in hasOne and belongsTo method 
        // return $this->belongsTo(Department::class, 'dept_id');
        return $this->belongsTo(Department::class);
    }
}
