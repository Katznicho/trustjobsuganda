<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'status',
        'cover_letter',
    ];

    /**
     * Get the job that the application is for.
     */
    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_id');
    }

    /**
     * Get the user who submitted the application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the job listing that the application is for (alias for job).
     */
    public function jobListing()
    {
        return $this->belongsTo(JobListing::class, 'job_id');
    }

    /**
     * Get the worker who applied (alias for user).
     */
    public function worker()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the employer who posted the job.
     */
    public function employer()
    {
        return $this->hasOneThrough(
            User::class,
            JobListing::class,
            'id', // Foreign key on job_listings table
            'id', // Foreign key on users table
            'job_id', // Local key on applications table
            'employer_id' // Local key on job_listings table
        );
    }
}
