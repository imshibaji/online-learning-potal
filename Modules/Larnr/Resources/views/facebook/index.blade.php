<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/">
  <channel>
    <title>News Publisher</title>
    <link>http://www.example.com/</link>
    <description>
      Read our awesome news, every day.
    </description>
    <language>en-us</language>
    <lastBuildDate>2014-12-11T04:44:16Z</lastBuildDate>
    <item>
      <title>This is an Instant Article</title>
      <link>http://example.com/article.html</link>
      <guid>2fd4e1c67a2d28fced849ee1bb76e7391b93eb12</guid>
      <pubDate>2014-12-11T04:44:16Z</pubDate>
      <author>Mr. Author</author>
      <description>This is my first Instant Article. How awesome is this?</description>
      <content:encoded>
        <![CDATA[
        <!doctype html>
        <html lang="en" prefix="op: http://media.facebook.com/op#">
          <head>
            <meta charset="utf-8">
            <link rel="canonical" href="http://example.com/article.html">
            <meta property="op:markup_version" content="v1.0">
          </head>
          <body>
            <article>
              <header>
                <!— Article header goes here -->
              </header>

              <!— Article body goes here -->

              <footer>
                <!— Article footer goes here -->
              </footer>
            </article>
          </body>
        </html>
        ]]>
      </content:encoded>
    </item>

    <!— Another Article (Each Article must be represented as an <item>)  -->
    <item>
      <title>This is another Instant Article</title>
      <link>http://example.com/another_article.html</link>
      <pubDate>2017-02-14T05:20:00Z</pubDate>
      <content:encoded>
        <![CDATA[
        <!doctype html>
        <html lang="en" prefix="op: http://media.facebook.com/op#">
          <head>
            <meta charset="utf-8">
            <link rel="canonical" href="http://example.com/another_article.html">
            <meta property="op:markup_version" content="v1.0">
          </head>
          <body>
            <article>
              <header>
                <!— Article header goes here -->
              </header>

              <!— Article body goes here -->

              <footer>
                <!— Article footer goes here -->
              </footer>
            </article>
          </body>
        </html>
        ]]>
      </content:encoded>
    </item>

  </channel>
</rss>
