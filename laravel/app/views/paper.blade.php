@extends('theme/main')
@section('title')
{{$paper['title']}} - Researchew
@endsection
@section('content')
<div class="am-container">
    <div class="paper am-article am-u-sm-10 am-u-sm-centered">
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
    <div class="review am-u-sm-10 am-u-sm-centered">
        <article class="am-comment">
            <a href="">
                <img class="am-comment-avatar" alt="User Avatar" src="{{asset('img/head.png')}}"/>
            </a>

            <div class="am-comment-main">
                <header class="am-comment-hd">
                    <div class="am-comment-meta">
                    <a href="#link-to-user" class="am-comment-author">..</a>
                    评论于 <time datetime="">...</time>
                    </div>
                </header>

                <div class="am-comment-bd">...</div>
            </div>
        </article>
    </div>
</div>
@endsection
@section('script')

@endsection
