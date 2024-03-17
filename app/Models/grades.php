<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grades extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('App\Models\User', 'teacher_id');
    }

    public function submission() {
        return $this->belongsTo('App\Models\submissions', 'submission_id');
    }
}
