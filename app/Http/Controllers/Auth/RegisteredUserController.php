<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use App\Models\UserSkill;
use App\Models\EducationRecord;
use App\Models\UserLanguage;
use App\Models\Reference;
use App\Models\Skill;
use App\Models\Language;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $skills = Skill::with('category')->get();
        $languages = Language::all();
        return view('auth.register', compact('skills', 'languages'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate basic information
        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_e164' => ['required', 'string', 'regex:/^\+256\d{9}$/', 'unique:'.User::class],
            'role' => ['required', 'in:worker,employer'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // Profile information
            'district' => ['required', 'string', 'max:60'],
            'division' => ['nullable', 'string', 'max:60'],
            'parish' => ['nullable', 'string', 'max:60'],
            'village' => ['nullable', 'string', 'max:60'],
            
            // Skills validation (for workers)
            'skills' => ['required_if:role,worker', 'array'],
            'skills.*.skill_id' => ['required_if:role,worker', 'exists:skills,id'],
            'skills.*.experience_tier' => ['required_if:role,worker', 'in:<6 months,6-12 months,1-2 years,2-5 years,>5 years'],
            'skills.*.has_certificate' => ['boolean'],
            'skills.*.institution_name' => ['required_if:skills.*.has_certificate,1', 'string', 'max:80'],
            'skills.*.certificate_name' => ['required_if:skills.*.has_certificate,1', 'string', 'max:80'],
            'skills.*.issue_date' => ['nullable', 'date'],
            
            // Education validation
            'education' => ['nullable', 'array'],
            'education.*.level' => ['required', 'in:None,Primary,O-Level,A-Level,Certificate,Diploma,Degree,Other'],
            'education.*.institution' => ['nullable', 'string', 'max:255'],
            'education.*.field_of_study' => ['nullable', 'string', 'max:255'],
            'education.*.year_completed' => ['nullable', 'integer', 'min:1950', 'max:' . (date('Y') + 1)],
            
            // Languages validation
            'languages' => ['nullable', 'array'],
            'languages.*.language_id' => ['required', 'exists:languages,id'],
            'languages.*.proficiency' => ['required', 'in:Basic,Conversational,Fluent'],
            
            // References validation
            'references' => ['nullable', 'array', 'max:3'],
            'references.*.name' => ['required', 'string', 'max:255'],
            'references.*.phone' => ['required', 'string', 'max:20'],
            'references.*.relationship' => ['required', 'string', 'max:255'],
            'references.*.can_contact' => ['boolean'],
        ]);

        // Create user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_e164' => $request->phone_e164,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Create profile
        Profile::create([
            'user_id' => $user->id,
            'district' => $request->district,
            'division' => $request->division,
            'parish' => $request->parish,
            'village' => $request->village,
        ]);

        // Create skills (for workers)
        if ($request->role === 'worker' && $request->has('skills')) {
            foreach ($request->skills as $skillData) {
                $yearsEstimate = $this->getYearsEstimate($skillData['experience_tier']);
                
                UserSkill::create([
                    'user_id' => $user->id,
                    'skill_id' => $skillData['skill_id'],
                    'experience_tier' => $skillData['experience_tier'],
                    'years_estimate' => $yearsEstimate,
                    'has_certificate' => $skillData['has_certificate'] ?? false,
                    'institution_name' => $skillData['institution_name'] ?? null,
                    'certificate_name' => $skillData['certificate_name'] ?? null,
                    'issue_date' => $skillData['issue_date'] ?? null,
                ]);
            }
        }

        // Create education records
        if ($request->has('education')) {
            foreach ($request->education as $educationData) {
                EducationRecord::create([
                    'user_id' => $user->id,
                    'level' => $educationData['level'],
                    'institution' => $educationData['institution'] ?? null,
                    'field_of_study' => $educationData['field_of_study'] ?? null,
                    'year_completed' => $educationData['year_completed'] ?? null,
                ]);
            }
        }

        // Create language records
        if ($request->has('languages')) {
            foreach ($request->languages as $languageData) {
                UserLanguage::create([
                    'user_id' => $user->id,
                    'language_id' => $languageData['language_id'],
                    'proficiency' => $languageData['proficiency'],
                ]);
            }
        }

        // Create references
        if ($request->has('references')) {
            foreach ($request->references as $referenceData) {
                Reference::create([
                    'user_id' => $user->id,
                    'name' => $referenceData['name'],
                    'phone' => $referenceData['phone'],
                    'relationship' => $referenceData['relationship'],
                    'can_contact' => $referenceData['can_contact'] ?? true,
                ]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    /**
     * Get years estimate from experience tier
     */
    private function getYearsEstimate($tier): float
    {
        return match($tier) {
            '<6 months' => 0.25,
            '6-12 months' => 0.75,
            '1-2 years' => 1.5,
            '2-5 years' => 3.5,
            '>5 years' => 6.0,
            default => 0.0,
        };
    }
}
