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
        'user_id', // Foreign key ke tabel users
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class)->select( 'id');
    }

    // Relasi ke model Classes
    public function class()
    {
        return $this->belongsTo(Classes::class)->select('id', 'name'); 
    }

    // Relasi ke Teacher (Wali Kelas)
    public function teacher()
    {
        return $this->belongsTo(Teacher::class)->select('id', 'name');
    }
}