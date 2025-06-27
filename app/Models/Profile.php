<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'bio',
        'phone',
        'location',
        'social_links',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    // Relación: un perfil pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
