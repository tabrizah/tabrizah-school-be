<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['card_uid', 'status'];

    protected $dates = ['date', 'time'];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
