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
                    <a href="#link-to-user" class="am-comment-author">#USERNAME#</a>
                    Add a review
                    </div>
                </header>

                <div class="am-comment-bd">

                </div>
            </div>
        </article>
    </div>
    <div class="review am-u-sm-10 am-u-sm-centered">
        @if(!Auth::check())
        <div class="am-alert am-alert-warning" data-am-alert>
        You need to <strong><a href="/user/login">Log In</a></strong> first before you review this paper.
        </div>
        @else
        <article class="am-comment">
            <a href="">
                <img class="am-comment-avatar" alt="User Avatar" src="{{asset('img/head.png')}}"/>
            </a>

            <div class="am-comment-main">
                <header class="am-comment-hd">
                    <div class="am-comment-meta">
                    Post review as <a href="#link-to-user" class="am-comment-author">{{Auth::user()->name}}</a>
                    </div>
                </header>
                <div class="am-comment-bd">
                    <form class="am-form">
                        <div class="am-form-group">
                            <label for="doc-ta-1">Rate the work!</label>
                            <div class="am-text-primary" id="new-rating"></div>

                        </div>
                        <div class="am-form-group">
                            <label for="content">Say something about the work</label>
                            <textarea class="" rows="5" id="new-content" name="content"></textarea>
                        </div>
                        <input type="hidden" name="id" value="{{$paper['id']}}">
                        <button type="submit" class="am-btn am-btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </article>
        @endif
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('packages/jquery.raty.js')}}"></script>
<script>
$('#new-rating').raty({
    scoreName: 'rating',
    target : '#new-content',
    targetFormat : 'I think it is a {score} work. ',
    targetKeep : true,
    click: function() {
        $('#new-content').focus();
    }
});
</script>
@endsection
