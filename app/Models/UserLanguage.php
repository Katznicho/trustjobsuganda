<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'language_id',
        'proficiency',
    ];

    /**
     * Get the user who speaks this language.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the language.
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
