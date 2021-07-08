@component('mail::message', [
    'appName' => 'Larnr Education',
    'appLink' => 'https://larnr.com'
])

# New Contact Enquery
### {{$contact->name}}

Mobile: {{$contact->mobile ?? 'No Number'}}

Email: {{$contact->email}}

Message: {{$contact->message}}

Thanks,<br>
Larnr Education
@endcomponent
