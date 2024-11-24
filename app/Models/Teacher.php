<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Classes;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'user_id', // Foreign key ke tabel users
        'class_id', // Optional
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class)->select( 'id');
    }

    // Relasi ke model Classes
    public function class()
    {
        return $this->belongsTo(Classes::class)->select( 'id', 'name');
    }

    
}