<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donSpecial extends Model
{
    use HasFactory;

    protected $fillable = [
      'date',
      'donateur',
      'don'
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }
}
