<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submissions extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User', 'student_id');
    }

    public function assignment() {
        return $this->belongsTo('App\Models\assignments', 'assignment_id');
    }

    public function grade() {
        return $this->hasOne('App\Models\grades', 'submission_id');
    }
}
