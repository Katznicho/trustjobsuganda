<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'relationship',
        'can_contact',
        'reference_letter_url',
    ];

    protected $casts = [
        'can_contact' => 'boolean',
    ];

    /**
     * Get the user who has this reference.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
