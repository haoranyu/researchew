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
    <ul class="reviews am-u-sm-10 am-u-sm-centered am-comment-list" id="reviews">
        @if(Session::has('success_msg'))
        <div class="am-alert am-alert-success" data-am-alert>
            {{ Session::get('success_msg') }}
        </div>
        @endif
        @foreach ($reviews as $review)
        <li class="am-comment am-comment-{{$review['flag']}} @if($review['rating'] < 3) am-comment-flip @endif" data-user="{{$review['user_id']}}">
            <a href="">
                <img class="am-comment-avatar" src="http://www.gravatar.com/avatar/{{$review['avatar']}}?d=monsterid" alt=""/>
            </a>

            <div class="am-comment-main">
                <header class="am-comment-hd">
                    <div class="am-comment-meta">
                    <a href="#link-to-user" class="am-comment-author">{{$review['user']->name}}</a> @ {{$review['created_at']}}
                    @if($review['user_id'] == Auth::user()->id)
                     <a class="am-icon-edit edit"></a>
                    @endif
                    <small class="am-text-{{$review['flag']}} am-fr">
                        @while($review['rating']--)
                        <span class="am-icon-star"></span>
                        @endwhile
                    </small>
                    </div>
                </header>

                <div class="am-comment-bd content">
                    {{$review['content']}}
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="review am-u-sm-10 am-u-sm-centered {{$logged_user_posted}}" >
        @if(!Auth::check())
        <div class="am-alert am-alert-warning" data-am-alert>
        You need to <strong><a href="/user/login">Log In</a></strong> first before you review this paper.
        </div>
        @else
        <article class="am-comment">
            <a href="">
                <img class="am-comment-avatar" alt="User Avatar" src="http://www.gravatar.com/avatar/{{md5( strtolower( trim( Auth::user()->email ) ) )}}?d=monsterid"/>
            </a>

            <div class="am-comment-main" id="new-review">
                <header class="am-comment-hd">
                    <div class="am-comment-meta">
                        @if($logged_user_posted != false)
                        Edit review as
                        @else
                        Post review as
                        @endif
                        <a href="#link-to-user" class="am-comment-author">{{Auth::user()->name}}</a>
                    </div>
                </header>
                <div class="am-comment-bd">
                    @if(Session::has('error_msg'))
                    <div class="am-alert am-alert-danger" data-am-alert>
                        {{ Session::get('error_msg') }}
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{ Form::open(array('url'=>'review/create', 'class'=>'am-form')) }}
                        <div class="am-form-group">
                            @if($logged_user_posted != false)
                            <label for="doc-ta-1">Rerate the work!</label>
                            @else
                            <label for="doc-ta-1">Rate the work!</label>
                            @endif

                            <div class="am-text-primary" id="new-rating"></div>
                        </div>
                        <div class="am-form-group">
                            <label for="content">Say something about the work</label>
                            {{ Form::textarea('content', null, array('class'=>'', 'rows'=>'5', 'id'=>'new-content', 'placeholder'=>'Please say something about how you think about this paper...')) }}

                        </div>
                        <input type="hidden" name="id" value="{{$paper['id']}}">
                        <button type="submit" class="am-btn am-btn-primary">Submit</button>
                    {{ Form::close() }}
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
    @if($logged_user_posted == false)
    target : '#new-content',
    targetFormat : 'I think it is a {score} work. ',
    targetKeep : true,
    @endif
    click: function() {
        $('#new-content').focus();
    }
});
$(document).on('click','[data-user="{{Auth::user()->id}}"] .edit', function() {
    $('.review').removeClass('am-hide');
    $('.review #new-content').val($('[data-user="{{Auth::user()->id}}"] .content').text().trim());
});

</script>
@endsection
