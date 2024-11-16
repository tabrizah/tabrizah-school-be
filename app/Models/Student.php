<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['nisn', 'name', 'class_id', 'teacher_id', 'user_id'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
    public function class() {
        return $this->belongsTo(Classes::class);
    }
}
