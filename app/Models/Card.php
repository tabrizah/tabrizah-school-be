<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

    protected $fillable = ['user_id', 'card_uid'];

    //protected $hidden = ['user'];
    public function user()
    {
        return $this->belongsTo(User::class)->select("id", "name");
    }

    /**
     * Event untuk generate UID sebelum membuat kartu baru
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($card) {
            // Jika card_uid tidak diisi, generate otomatis 8 angka unik
            if (empty($card->card_uid)) {
                do {
                    $card->card_uid = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
                } while (self::where('card_uid', $card->card_uid)->exists());
            }
        });
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}