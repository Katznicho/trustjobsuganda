<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'required_skill_ids',
        'min_experience_tier',
        'district',
        'division',
        'parish',
        'village',
        'latitude',
        'longitude',
        'budget',
        'pay_type',
        'urgent',
        'status',
    ];

    protected $casts = [
        'required_skill_ids' => 'array',
        'budget' => 'decimal:2',
        'urgent' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the employer who posted this job.
     */
    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    /**
     * Get the applications for this job.
     */
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    /**
     * Get the ratings for this job.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'job_id');
    }
}
