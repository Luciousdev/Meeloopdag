<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignments extends Model
{
    use HasFactory;

    public function creator() {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function submissions() {
        return $this->hasMany('App\Models\submissions', 'assignment_id');
    }
}
