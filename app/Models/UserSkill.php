<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_id',
        'experience_tier',
        'years_estimate',
        'has_certificate',
        'institution_name',
        'certificate_name',
        'issue_date',
        'certificate_file_url',
    ];

    protected $casts = [
        'has_certificate' => 'boolean',
        'years_estimate' => 'decimal:1',
        'issue_date' => 'date',
    ];

    /**
     * Get the user this skill belongs to.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the skill.
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
