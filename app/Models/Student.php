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
        return $this->hasOne(Teacher::class)->select('id', 'name');
    }

    
}