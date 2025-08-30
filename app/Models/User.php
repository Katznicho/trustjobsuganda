<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_e164',
        'whatsapp_verified_at',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'whatsapp_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's profile.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the user's skills.
     */
    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }

    /**
     * Get the user's education records.
     */
    public function educationRecords()
    {
        return $this->hasMany(EducationRecord::class);
    }

    /**
     * Get the user's languages.
     */
    public function userLanguages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    /**
     * Get the user's references.
     */
    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    /**
     * Get the jobs posted by this employer.
     */
    public function jobListings()
    {
        return $this->hasMany(JobListing::class, 'employer_id');
    }

    /**
     * Get the applications submitted by this worker.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the ratings given by this user.
     */
    public function ratingsGiven()
    {
        return $this->hasMany(Rating::class, 'rater_id');
    }

    /**
     * Get the ratings received by this user.
     */
    public function ratingsReceived()
    {
        return $this->hasMany(Rating::class, 'ratee_id');
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a worker.
     */
    public function isWorker(): bool
    {
        return $this->role === 'worker';
    }

    /**
     * Check if user is an employer.
     */
    public function isEmployer(): bool
    {
        return $this->role === 'employer';
    }
}
