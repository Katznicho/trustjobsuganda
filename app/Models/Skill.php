<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
    ];

    /**
     * Get the category this skill belongs to.
     */
    public function category()
    {
        return $this->belongsTo(SkillCategory::class, 'category_id');
    }

    /**
     * Get the users who have this skill.
     */
    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }
}
