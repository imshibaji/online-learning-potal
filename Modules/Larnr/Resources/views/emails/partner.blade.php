@component('mail::message', [
    'appName' => 'Larnr Education',
    'appLink' => 'https://larnr.com'
])

# New Partner Enquery
### {{$partner->name}}
Mobile: {{$partner->mobile ?? 'No Number'}}

Email: {{$partner->email}}

Subject: {{$partner->subject}}

Message: {{$partner->message}}

Thanks,<br>
Larnr Education
@endcomponent
