<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'photo_url',
        'birth_year',
        'gender',
        'district',
        'division',
        'parish',
        'village',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'birth_year' => 'integer',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the user this profile belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
