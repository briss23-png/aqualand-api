<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom', 'email', 'password', 'telephone', 'role', 'agent_id'
    ];

    protected $hidden = [
        'password',
    ];

    public function collectes()
    {
        return $this->hasMany(Collecte::class);
    }
}