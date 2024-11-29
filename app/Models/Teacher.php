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
        'user_id', 
        'class_id',
    ];
    
    protected $hidden = ['user'];

    // protected static function booted()
    // {
    //     static::creating(function ($teacher) {
    //         $teacher->name = $teacher->user->name; // Salin nama dari user
    //     });
    // }
    public function user()
    {
        return $this->belongsTo(User::class)->select( 'id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class)->select( 'id', 'name');
    }

    
}