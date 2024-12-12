<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes'; 
    protected $fillable = [
        'name',
        'total_student',
        'teacher_id',
    ];

    public function getTotalStudentAttribute()
    {
        return $this->students()->count(); 
    }
    
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'class_id')->select( 'id', "name");  
    }


    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'id');  
    }
}