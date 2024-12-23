<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'caisse_id',
        'date_de_la_transaction',
        'type_de_transaction',
        'code_de_depense',
        'montant',
        'motif',
        'source',
        'pourcentage_eglise',
        'montant_net_restant',
    ];

    protected function casts(): array
    {
        return [
            "date_de_la_transaction"=>"date",
        ];
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class, 'caisse_id');
    }
}
