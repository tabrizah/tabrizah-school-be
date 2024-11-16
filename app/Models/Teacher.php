<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'class_id', 'user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function class() {
        return $this->belongsTo(Classes::class);
    }
}
