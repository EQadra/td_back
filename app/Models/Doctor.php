<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization',
        'license_number',
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
