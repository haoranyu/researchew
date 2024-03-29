@extends('theme/main')
@section('title')
{{$paper['title']}} - Researchew
@endsection
@section('content')

<div class="am-container">
    <div class="paper am-article am-u-md-10 am-u-md-centered am-u-sm-12">
        <div class="am-article-hd">
            <h1 class="am-article-title">{{$paper['title']}}</h1>
            <ol class="author am-article-meta am-icon-user">
                @foreach ($paper['author'] as $author)
                    <li>{{$author->name}}</li>
                @endforeach
            </ol>
        </div>
        @if(array_sum($review_distribute) != 0)
        <div class="am-article-hd">
            <div class="am-progress">
                <div class="am-progress-bar am-progress-bar-success"  style="width: {{$review_distribute[5]}}%">Gorgeous</div>
                <div class="am-progress-bar am-progress-bar-secondary"  style="width: {{$review_distribute[4]}}%">Good</div>
                <div class="am-progress-bar"  style="width: {{$review_distribute[3]}}%">Regular</div>
                <div class="am-progress-bar am-progress-bar-warning"  style="width: {{$review_distribute[2]}}%">Poor</div>
                <div class="am-progress-bar am-progress-bar-danger"  style="width: {{$review_distribute[1]}}%">Bad</div>
            </div>
        </div>
        @endif
        <div class="am-article-bd">
            <div class="am-article-lead am-g">
                <div class="am-u-md-8 am-u-xs-12" id="abstract">
                    {{$paper['abstract']}}
                </div>
                <div class="am-u-md-4 am-u-xs-12" id="cloud">
                </div>
            </div>
        </div>

        <div class="am-article-divider"></div>

        @if($new_idea)
        <div class="am-article-bd">
            <div class="am-article-lead am-g">
                <strong>Recommended keywords about new ideas: </strong>
                @foreach($new_idea as $key => $value)
                    <span title="Rank: {{$value}}">{{$key}}</span>
                @endforeach
            </div>
        </div>
        @endif

        <div class="am-article-divider"></div>
        <div class="am-article-meta">
            <a href="{{$paper['id']}}" target="blank" class="am-icon-external-link">
                Full Text
            </a>
             /
            Publish date: {{date("Y-m-d h:i", $paper['date'])}} / Indexed time: {{$paper['created_at']}}
        </div>
    </div>
    <ul class="reviews am-u-md-10 am-u-md-centered am-u-sm-12 am-comment-list" id="reviews">
        @if(Session::has('success_msg'))
        <div class="am-alert am-alert-success" data-am-alert>
            {{ Session::get('success_msg') }}
        </div>
        @endif
        @foreach ($reviews as $review)
        <li class="am-comment am-comment-{{$review['flag']}} @if($review['rating'] < 3) am-comment-flip @endif" data-user="{{$review['user_id']}}" data-reviewid="{{$review['id']}}">
            <a href="">
                <img class="am-comment-avatar" src="http://www.gravatar.com/avatar/{{$review['avatar']}}?d=monsterid" alt=""/>
            </a>

            <div class="am-comment-main">
                <header class="am-comment-hd">
                    <div class="am-comment-meta">
                    <a href="#link-to-user" class="am-comment-author">{{$review['user']->name}}</a> @ {{$review['created_at']}}
                    @if(Auth::check())
                        @if($review['user_id'] == Auth::user()->id)
                         - <a class="am-icon-edit edit" href="#new-review"></a>
                         - <a class="am-icon-trash-o delete"></a>
                        @elseif(Auth::user()->role == 1)
                         - <a class="am-icon-trash-o delete"></a>
                        @endif
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
    <div class="review am-u-md-10 am-u-md-centered am-u-sm-12 {{$logged_user_posted}}" >
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
                        <span id="new-review-title">
                            @if($logged_user_posted != false)
                            Edit review as
                            @else
                            Post review as
                            @endif
                        </span>
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
                            Rate the work!

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
<script src="{{asset('packages/jqcloud-1.0.4.js')}}"></script>
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
@if(Auth::check())
$(document).on('click','.edit', function() {
    $('.review').removeClass('am-hide');
    $('.review #new-content').val($('[data-user="{{Auth::user()->id}}"] .content').text().trim());
});
$(document).on('click','.delete', function(){
    var review = $(this).parents('li');
    $.ajax({
        url: '/review/delete',
        type: 'POST',
        data:{id: review.data('reviewid')},
        dataType: 'json',
        timeout: 13000,
        success: function(data){
            alert('You have successfully removed your review and you can post a new one if you want.');
            $('.review').removeClass('am-hide');
            review.remove();
            $('#new-review-title').text('Post review as');
        }
    });
});
@endif

@if($bow != false)
$('#cloud').height($('#abstract').height());
@endif

var word_array = [
    @foreach($bow as $word => $freq)
        {text: "{{$word}}", weight: {{$freq}}},
    @endforeach
];

$("#cloud").jQCloud(word_array);

</script>
@endsection
