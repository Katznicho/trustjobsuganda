<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Professional CV - {{ $user->full_name }}</title>
    <style>
        @page {
            margin: 0.4in;
            size: A4;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Calibri', 'Arial', sans-serif;
            line-height: 1.4;
            color: #2c3e50;
            background: #ffffff;
            font-size: 11px;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Header Section */
        .header {
            background: #2c3e50;
            color: white;
            padding: 25px 30px;
            margin-bottom: 20px;
            position: relative;
        }
        
        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2980b9, #1abc9c);
        }
        
        .header h1 {
            font-size: 28px;
            font-weight: 300;
            margin-bottom: 5px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .header .title {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 15px;
            font-weight: 400;
        }
        
        .contact-info {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            font-size: 11px;
            color: #ecf0f1;
        }
        
        .contact-item .icon {
            width: 14px;
            height: 14px;
            margin-right: 6px;
            background: #34495e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
        }
        
        /* Main Content Layout */
        .content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
        }
        
        .sidebar {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 0;
        }
        
        .main-content {
            padding: 0 5px;
        }
        
        /* Section Styling */
        .section {
            margin-bottom: 20px;
        }
        
        .section-title {
            color: #2c3e50;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid #3498db;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Professional Summary */
        .summary {
            background: #ecf0f1;
            padding: 15px;
            border-left: 4px solid #3498db;
            font-style: normal;
            color: #2c3e50;
            line-height: 1.5;
            margin-bottom: 20px;
        }
        
        /* Skills Section */
        .skills-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 8px;
        }
        
        .skill-item {
            background: white;
            padding: 12px;
            border-radius: 4px;
            border-left: 3px solid #3498db;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .skill-name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 12px;
            margin-bottom: 4px;
        }
        
        .skill-details {
            color: #7f8c8d;
            font-size: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .experience-level {
            background: #3498db;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 500;
        }
        
        .certificate-info {
            background: #27ae60;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 500;
            margin-left: 5px;
        }
        
        /* Languages */
        .language-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            background: white;
            margin-bottom: 6px;
            border-radius: 4px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .language-name {
            font-weight: 500;
            color: #2c3e50;
            font-size: 11px;
        }
        
        .proficiency-level {
            background: #2c3e50;
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 500;
            text-transform: uppercase;
        }
        
        /* Education */
        .education-item {
            background: white;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 3px solid #e74c3c;
        }
        
        .education-title {
            font-weight: 600;
            color: #2c3e50;
            font-size: 12px;
            margin-bottom: 4px;
        }
        
        .education-details {
            color: #7f8c8d;
            font-size: 10px;
            line-height: 1.3;
        }
        
        .education-period {
            color: #95a5a6;
            font-size: 9px;
            font-style: italic;
        }
        
        /* References */
        .reference-item {
            background: white;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-left: 3px solid #f39c12;
        }
        
        .reference-name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 12px;
            margin-bottom: 4px;
        }
        
        .reference-details {
            color: #7f8c8d;
            font-size: 10px;
            line-height: 1.3;
        }
        
        /* Availability Status */
        .availability-status {
            text-align: center;
            padding: 10px;
            background: white;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .available { background: #d5f4e6; color: #27ae60; }
        .busy { background: #fef9e7; color: #f39c12; }
        .unavailable { background: #fadbd8; color: #e74c3c; }
        
        /* Professional Stats */
        .stats-container {
            background: white;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        
        .stat-item {
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
        }
        
        .stat-number {
            font-size: 16px;
            font-weight: 700;
            color: #3498db;
            display: block;
        }
        
        .stat-label {
            font-size: 9px;
            color: #7f8c8d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Contact Information in Sidebar */
        .contact-sidebar {
            background: white;
            padding: 15px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        
        .contact-sidebar h3 {
            color: #2c3e50;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .contact-sidebar .contact-item {
            margin-bottom: 8px;
            color: #2c3e50;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #bdc3c7;
            color: #95a5a6;
            font-size: 9px;
        }
        
        /* Print optimizations */
        @media print {
            .container {
                max-width: none;
            }
            .header {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            .section-title {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }
        
        /* Professional spacing */
        .section + .section {
            margin-top: 15px;
        }
        
        /* Enhanced typography */
        h1, h2, h3 {
            font-family: 'Calibri', 'Arial', sans-serif;
        }
        
        /* Professional color scheme */
        .primary-color { color: #2c3e50; }
        .secondary-color { color: #3498db; }
        .accent-color { color: #e74c3c; }
        .text-muted { color: #7f8c8d; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Professional Header -->
        <div class="header">
            <h1>{{ $user->full_name }}</h1>
            <div class="title">Professional Worker</div>
            <div class="contact-info">
                <div class="contact-item">
                    <div class="icon">✉</div>
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
                    <span class="status-badge {{ $user->profile->availability }}">
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
                    <h2 class="section-title">Professional Summary</h2>
                    <div class="summary">{{ $user->profile->bio }}</div>
                </div>
                @endif

                @if($user->userSkills && $user->userSkills->count() > 0)
                <div class="section">
                    <h2 class="section-title">Core Competencies</h2>
                    <div class="skills-grid">
                        @foreach($user->userSkills as $userSkill)
                        <div class="skill-item">
                            <div class="skill-name">{{ $userSkill->skill->name }}</div>
                            <div class="skill-details">
                                <span class="experience-level">{{ $userSkill->experience_tier }}</span>
                                @if($userSkill->has_certificate)
                                    <span class="certificate-info">Certified</span>
                                @endif
                            </div>
                            @if($userSkill->has_certificate && $userSkill->certificate_name && $userSkill->institution_name)
                            <div class="skill-details" style="margin-top: 4px; font-size: 9px;">
                                <strong>Certificate:</strong> {{ $userSkill->certificate_name }} from {{ $userSkill->institution_name }}
                                @if($userSkill->issue_date)
                                    ({{ \Carbon\Carbon::parse($userSkill->issue_date)->format('M Y') }})
                                @endif
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($user->educationRecords && $user->educationRecords->count() > 0)
                <div class="section">
                    <h2 class="section-title">Education & Training</h2>
                    @foreach($user->educationRecords as $education)
                    <div class="education-item">
                        <div class="education-title">{{ $education->institution_name }}</div>
                        <div class="education-details">
                            <strong>{{ $education->degree }}</strong> in {{ $education->field_of_study }}
                        </div>
                        <div class="education-period">
                            {{ \Carbon\Carbon::parse($education->start_date)->format('Y') }} - 
                            {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('Y') : 'Present' }}
                        </div>
                        @if($education->description)
                        <div class="education-details" style="margin-top: 4px;">
                            {{ $education->description }}
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif

                @if($user->references && $user->references->count() > 0)
                <div class="section">
                    <h2 class="section-title">Professional References</h2>
                    @foreach($user->references as $reference)
                    <div class="reference-item">
                        <div class="reference-name">{{ $reference->name }}</div>
                        <div class="reference-details">
                            <strong>{{ $reference->position }}</strong> at {{ $reference->company }}
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

            <!-- Professional Sidebar -->
            <div class="sidebar">
                <!-- Contact Information -->
                <div class="contact-sidebar">
                    <h3>Contact Information</h3>
                    <div class="contact-item">
                        <div class="icon">✉</div>
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
                </div>

                <!-- Availability Status -->
                @if($user->profile && $user->profile->availability)
                <div class="availability-status">
                    <h3 style="color: #2c3e50; font-size: 12px; font-weight: 600; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Current Status</h3>
                    <span class="status-badge {{ $user->profile->availability }}">
                        {{ ucfirst($user->profile->availability) }}
                    </span>
                </div>
                @endif

                <!-- Languages -->
                @if($user->userLanguages && $user->userLanguages->count() > 0)
                <div class="section">
                    <h2 class="section-title">Languages</h2>
                    @foreach($user->userLanguages as $userLanguage)
                    <div class="language-item">
                        <span class="language-name">{{ $userLanguage->language->name }}</span>
                        <span class="proficiency-level">{{ ucfirst($userLanguage->proficiency) }}</span>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Professional Statistics -->
                <div class="section">
                    <h2 class="section-title">Profile Statistics</h2>
                    <div class="stats-container">
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
                            @else
                            <div class="stat-item">
                                <span class="stat-number">-</span>
                                <span class="stat-label">Rating</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <strong>TrustJobs Uganda</strong> - Professional Job Platform | Generated on {{ now()->format('F d, Y') }}
        </div>
    </div>
</body>
</html>