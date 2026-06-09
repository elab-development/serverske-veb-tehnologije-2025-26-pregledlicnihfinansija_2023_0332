<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transakcija extends Model
{
    protected $table = 'transakcije';

    protected $fillable = [
        'klijent_id',
        'kategorija_id',
        'kolicina',
        'datum',
    ];

    protected function casts(): array
    {
        return [
            'kolicina' => 'double',
            'datum' => 'date',
        ];
    }

    public function klijent()
    {
        return $this->belongsTo(Klijent::class);
    }

    public function kategorija()
    {
        return $this->belongsTo(Kategorija::class);
    }
}