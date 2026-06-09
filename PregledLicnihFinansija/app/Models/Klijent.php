<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klijent extends Model
{
    protected $table = 'klijenti';

    protected $fillable = [
        'user_id',
        'net_worth',
        'premium_klijent',
        'preferred_currency',
    ];

    protected function casts(): array
    {
        return [
            'net_worth' => 'double',
            'premium_klijent' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPremium(): bool
    {
        return $this->premium_klijent === true;
    }
    public function transakcije()
    {
        return $this->hasMany(Transakcija::class);
    }
    public function krediti()
    {
        return $this->hasMany(Kredit::class);
    }
}
