@extends('theme/main')
@section('title')
{{$paper['title']}} - Researchew
@endsection
@section('content')
<div class="am-container">
    <div class="paper am-article">
        <div class="am-article-hd">
            <h1 class="am-article-title">{{$paper['title']}}</h1>
            <ol class="author am-article-meta am-icon-user">
                @foreach ($paper['author'] as $author)
                    <li>{{$author->name}}</li>
                @endforeach
            </ol>
        </div>
        <div class="am-article-bd">
            <div class="am-article-lead">
                {{$paper['abstract']}}
            </div>
        </div>
        <div class="am-article-divider"></div>
        <div class="am-article-meta">
            <a href="{{$paper['id']}}" target="blank" class="am-icon-external-link">
                Full Text
            </a>
             /
            Publish date: {{date("Y-m-d h:i", $paper['date'])}} / Indexed time: {{$paper['created_at']}}
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
