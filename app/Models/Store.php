<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_name',
        'ruc',
        'logo',
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
