<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field',
        'whatsapp_link',
        'bar_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
{
    return $this->morphMany(Rating::class, 'rateable');
}
}
