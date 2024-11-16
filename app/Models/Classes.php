<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = ['name', 'total_student', 'teacher_id'];
    public function students() {
        return $this->hasMany(Student::class);
    }
    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}
