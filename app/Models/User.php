<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'photo',
        'nom',
        'postnom',
        'prenom',
        'sexe',
        'lieu_de_naissance',
        'date_de_naissance',
        'etat_civil',
        'adresse',
        'telephone',
        'email',
        'password',
        'paroisses_id',
        'departement_id',
        'qualite_id',
        'groupe_utilisateur_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->photo);
    }

    public function rapport_mensuels() {
        return $this->hasMany(RapportMensuel::class);
    }

    public function qualite()
    {
        return $this->belongsTo(Qualites::class, "qualite_id");
    }

    public function departement()
    {
        return $this->belongsTo(Departements::class, "departement_id");
    }

    public function groupe_utilisateur()
    {
        return $this->belongsTo(GroupesUtilisateurs::class, "groupe_utilisateur_id");
    }
}
