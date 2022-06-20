<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

@foreach ($posts as $post)
    <url>
        <loc>{{url('post/'.$post->slug)}}</loc>
        <lastmod>{{$post->updated_at->format('Y-m-d')}}</lastmod>
        <priority>0.80</priority>
    </url>
@endforeach
</urlset>
