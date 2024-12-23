<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'departement_id',
        'caissier_id',
    ];

    public function departement() {
        return $this->belongsTo(Departements::class, 'departement_id');
    }

    public function caissier() {
        return $this->belongsTo(User::class, 'caissier_id');
    }

    public function transactions() {
        return $this->hasMany(Transactions::class);
    }
}
