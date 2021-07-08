@component('mail::message', [
    'appName' => 'Larnr Education',
    'appLink' => 'https://larnr.com'
])

# New Article
### {{$article->title}}

![Image]({{ asset('storage/'.$article->image_path) }})

{{$article->description}}

@component('mail::button', [ 'url' => 'https://larnr.com/article/'.$article->slug ])
Read More
@endcomponent

Thanks,<br>
Larnr Education
@endcomponent
