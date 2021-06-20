<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
xmlns:video="http://www.google.com/schemas/sitemap-video/1.1">

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>https://larnr.com/sitemap/articles</loc>
        <lastmod>{{ $article->publishes_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://larnr.com/sitemap/categories</loc>
        <lastmod>{{ $article->publishes_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://larnr.com/sitemap/course</loc>
        <lastmod>{{ $course->publishes_at->tz('UTC')->toAtomString() }}</lastmod>
    </sitemap>
</sitemapindex>

</urlset>
