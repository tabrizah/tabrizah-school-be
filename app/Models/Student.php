<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Classes;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'nisn',
        'name',
        'class_id',
        'teacher_id',
        'user_id', 
    ];

    // protected static function booted()
    // {
    //     static::creating(function ($student) {
    //         // Salin nama dari user
    //         $student->name = $student->user->name;
    
    //         // Tetapkan teacher_id berdasarkan class_id
    //         if (!$student->teacher_id && $student->class_id) {
    //             $teacher = Teacher::where('class_id', $student->class_id)->first();
    //             $student->teacher_id = $teacher ? $teacher->id : null;
    //         }
    //     });

    //     static::saved(function ($student) {
    //         if ($student->class) {
    //             $student->class->touch();
    //         }
    //     });
    // }
    
    public function user()
    {
        return $this->belongsTo(User::class)->select( 'id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class)->select('id', 'name'); 
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class)->select('id', 'name');
    }

    
}