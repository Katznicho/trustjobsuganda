<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level',
        'institution',
        'field_of_study',
        'year_completed',
    ];

    /**
     * Get the user who has this education record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
