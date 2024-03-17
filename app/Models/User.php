<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function submissions() {
        return $this->hasMany('App\Models\submissions', 'student_id');
    }

    public function grades() {
        return $this->hasMany('App\Models\grades', 'teacher_id');
    }

    public function assignments() {
        return $this->hasMany('App\Models\assignments', 'created_by');
    }
}
