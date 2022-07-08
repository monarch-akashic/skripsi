@component('mail::message')
# Your interview has been schedule

Your job apply for {{ $vacancy['job_name'] }} is scheduled

Time: {{ $interview['interview_time'] }}
Location: {{ $interview['interview_location'] }}
Note: {{ $interview['notes'] }}

Thank you,

{{ config('app.name') }}
@endcomponent
