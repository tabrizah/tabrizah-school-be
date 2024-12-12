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

    public function user()
    {
        return $this->belongsTo(User::class)->select( 'id');
    }

    public function class()
    {
    return $this->hasOne(Classes::class, 'teacher_id', 'id')->select('id', 'name');
    }

    
}