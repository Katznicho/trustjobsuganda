<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Get the users who speak this language.
     */
    public function userLanguages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    /**
     * Get the users who speak this language.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_languages')
                    ->withPivot('proficiency')
                    ->withTimestamps();
    }
}
