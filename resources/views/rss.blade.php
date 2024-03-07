<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>
<rss version="2.0">
    <channel>
        <title><![CDATA[ LaravelTuts.com ]]></title>
        <link><![CDATA[ https://laraveltuts.com/feed ]]></link>
        <description><![CDATA[ Learn Laravel with LaravelTuts.com ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>
  
        @foreach($jobs as $job)
            <item>
                <title><![CDATA[{{ $job->title }}]]></title>
                {{-- <link>{{ $job->slug }}</link> --}}
                <description><![CDATA[{!! $job->body !!}]]></description>
                <company>{{ $job->company->name }}</company>
                <author><![CDATA[Hardk Savani]]></author>
                <guid>{{ $job->id }}</guid>
                <pubDate>{{ $job->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>