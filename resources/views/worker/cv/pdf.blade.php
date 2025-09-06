<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV - {{ $user->full_name }}</title>
    <style>
        @page {
            margin: 0.5in;
            size: A4;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: #ffffff;
            font-size: 11px;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Header Section */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            margin-bottom: 25px;
            border-radius: 8px;
        }
        
        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        
        .header .title {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 15px;
        }
        
        .contact-grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            font-size: 12px;
        }
        
        .contact-item .icon {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Main Content */
        .content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
        }
        
        .sidebar {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            height: fit-content;
        }
        
        .main-content {
            padding: 0 10px;
        }
        
        /* Section Styling */
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            color: #4a5568;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 30px;
            height: 2px;
            background: #667eea;
        }
        
        /* Bio Section */
        .bio {
            background: #f7fafc;
            padding: 20px;
            border-left: 4px solid #667eea;
            border-radius: 0 8px 8px 0;
            font-style: italic;
            color: #4a5568;
            line-height: 1.7;
        }
        
        /* Skills Section */
        .skill-item {
            background: white;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-left: 3px solid #667eea;
        }
        
        .skill-name {
            font-weight: 600;
            color: #2d3748;
            font-size: 13px;
            margin-bottom: 5px;
        }
        
        .skill-details {
            color: #718096;
            font-size: 11px;
        }
        
        .experience-badge {
            display: inline-block;
            background: #e6fffa;
            color: #234e52;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 500;
            margin-top: 5px;
        }
        
        .certificate-badge {
            display: inline-block;
            background: #f0fff4;
            color: #22543d;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 500;
            margin-left: 8px;
        }
        
        /* Languages */
        .language-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            background: white;
            margin-bottom: 8px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .language-name {
            font-weight: 500;
            color: #2d3748;
        }
        
        .proficiency-badge {
            background: #667eea;
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 500;
        }
        
        /* Education */
        .education-item {
            background: white;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .education-title {
            font-weight: 600;
            color: #2d3748;
            font-size: 13px;
            margin-bottom: 5px;
        }
        
        .education-details {
            color: #718096;
            font-size: 11px;
        }
        
        /* References */
        .reference-item {
            background: white;
            padding: 15px;
            margin-bottom: 12px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .reference-name {
            font-weight: 600;
            color: #2d3748;
            font-size: 13px;
            margin-bottom: 5px;
        }
        
        .reference-details {
            color: #718096;
            font-size: 11px;
        }
        
        /* Availability */
        .availability-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .available { background: #c6f6d5; color: #22543d; }
        .busy { background: #fef5e7; color: #744210; }
        .unavailable { background: #fed7d7; color: #742a2a; }
        
        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }
        
        .stat-item {
            text-align: center;
            padding: 15px;
            background: white;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
            display: block;
        }
        
        .stat-label {
            font-size: 10px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            color: #a0aec0;
            font-size: 10px;
        }
        
        /* Responsive adjustments for PDF */
        @media print {
            .container {
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $user->full_name }}</h1>
            <div class="contact-grid">
                <div class="contact-item">
                    <div class="icon">📧</div>
                    {{ $user->email }}
                </div>
                @if($user->phone)
                <div class="contact-item">
                    <div class="icon">📱</div>
                    {{ $user->phone }}
                </div>
                @endif
                @if($user->profile && $user->profile->location)
                <div class="contact-item">
                    <div class="icon">📍</div>
                    {{ $user->profile->location }}
                </div>
                @endif
                @if($user->profile && $user->profile->availability)
                <div class="contact-item">
                    <div class="icon">⏰</div>
                    <span class="availability-badge {{ $user->profile->availability }}">
                        {{ ucfirst($user->profile->availability) }}
                    </span>
                </div>
                @endif
            </div>
        </div>

        <div class="content">
            <!-- Main Content -->
            <div class="main-content">
                @if($user->profile && $user->profile->bio)
                <div class="section">
                    <h2 class="section-title">About Me</h2>
                    <div class="bio">{{ $user->profile->bio }}</div>
                </div>
                @endif

                @if($user->userSkills && $user->userSkills->count() > 0)
                <div class="section">
                    <h2 class="section-title">Skills & Experience</h2>
                    @foreach($user->userSkills as $userSkill)
                    <div class="skill-item">
                        <div class="skill-name">{{ $userSkill->skill->name }}</div>
                        <div class="skill-details">
                            <span class="experience-badge">{{ $userSkill->experience_tier }}</span>
                            @if($userSkill->has_certificate)
                                <span class="certificate-badge">Certified</span>
                            @endif
                        </div>
                        @if($userSkill->has_certificate && $userSkill->certificate_name && $userSkill->institution_name)
                        <div class="skill-details">
                            <strong>Certificate:</strong> {{ $userSkill->certificate_name }} from {{ $userSkill->institution_name }}
                            @if($userSkill->issue_date)
                                ({{ \Carbon\Carbon::parse($userSkill->issue_date)->format('M Y') }})
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                @if($user->educationRecords && $user->educationRecords->count() > 0)
                <div class="section">
                    <h2 class="section-title">Education</h2>
                    @foreach($user->educationRecords as $education)
                    <div class="education-item">
                        <div class="education-title">{{ $education->institution_name }}</div>
                        <div class="education-details">
                            {{ $education->degree }} in {{ $education->field_of_study }}
                            ({{ \Carbon\Carbon::parse($education->start_date)->format('Y') }} - 
                            {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('Y') : 'Present' }})
                        </div>
                        @if($education->description)
                        <div class="education-details">{{ $education->description }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                @if($user->references && $user->references->count() > 0)
                <div class="section">
                    <h2 class="section-title">References</h2>
                    @foreach($user->references as $reference)
                    <div class="reference-item">
                        <div class="reference-name">{{ $reference->name }}</div>
                        <div class="reference-details">
                            {{ $reference->position }} at {{ $reference->company }}
                            @if($reference->relationship)
                                ({{ $reference->relationship }})
                            @endif
                        </div>
                        <div class="reference-details">
                            {{ $reference->phone }}
                            @if($reference->email)
                                | {{ $reference->email }}
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                @if($user->userLanguages && $user->userLanguages->count() > 0)
                <div class="section">
                    <h2 class="section-title">Languages</h2>
                    @foreach($user->userLanguages as $userLanguage)
                    <div class="language-item">
                        <span class="language-name">{{ $userLanguage->language->name }}</span>
                        <span class="proficiency-badge">{{ ucfirst($userLanguage->proficiency) }}</span>
                    </div>
                    @endforeach
                </div>
                @endif

                <div class="section">
                    <h2 class="section-title">Quick Stats</h2>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">{{ $user->applications->count() }}</span>
                            <span class="stat-label">Applications</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $user->userSkills->count() }}</span>
                            <span class="stat-label">Skills</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $user->userLanguages->count() }}</span>
                            <span class="stat-label">Languages</span>
                        </div>
                        @if($user->ratingsReceived->count() > 0)
                        <div class="stat-item">
                            <span class="stat-number">{{ number_format($user->ratingsReceived->avg('stars'), 1) }}</span>
                            <span class="stat-label">Rating</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            Generated on {{ now()->format('F d, Y') }} | TrustJobs Uganda - Professional Job Platform
        </div>
    </div>
</body>
</html>