@extends('theme/main')
@section('title')
{{$query}} - Researchew
@endsection
@section('content')
<div class="am-container">
    <div class="search-result am-u-sm-10 am-u-sm-centered">
        <ol class="am-breadcrumb">
            <li><a href="../../">Search</a></li>
            <li class="active">Keyword: {{$query}}</li>
        </ol>
        @if(isset($reviews) && $reviews && $page == 1)
        <section class="am-panel am-panel-secondary">
            <div class="am-panel-hd">Recent 5 related reviews</div>
            <ul class="am-list am-list-static">
                @foreach ($reviews as $review)
                <li>
                    @<strong>{{User::find($review['user_id'])->name}}</strong>:  {{$review['content']}}
                    <small>
                        <a target="_blank" href="../../paper/{{hash('sha1', $review['id'])}}" class="am-icon-external-link"></a>
                    </small>
                </li>
                @endforeach
            </ul>
        </section>
        @endif
        @if(!$empty)
        <ul class="result">
            @foreach ($results as $result)
                <li class="am-article" data-id="{{$result['id']}}">
                    <h3 class="am-article-hd">
                        <a target="_blank" href="../../paper/{{hash('sha1', $result['id'])}}">
                            {{$result['title']}}
                        </a>
                        <a href="{{$result['link'][0]['@attributes']['href']}}">
                            <small class="am-icon-external-link"></small>
                        </a>
                    </h3>
                    <ol class="author am-article-meta am-icon-user">
                        @foreach ($result['author'] as $author)
                            <li>{{$author['name']}}</li>
                        @endforeach
                    </ol>
                    <div class="am-article-meta am-icon-clock-o"> {{$result['published']}} </div>
                    <p class="am-article-bd">{{$result['summary']}}</p>

                </li>
            @endforeach
            </ul>
            <nav>
                <ul class="am-pagination">
                <li class="am-pagination-prev {{$prev}}"><a href="{{$page-1}}"><span aria-hidden="true" class="am-icon-angle-left"></span> Previous</a></li>
                <li class="am-pagination-next {{$next}}"><a href="{{$page+1}}">Next <span aria-hidden="true" class="am-icon-angle-right"></span></a></li>
                </ul>
            </nav>
        @else
        <ul class="result">
            There is nothing more about {{$query}}...
        </ul>
        @endif
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).on('click', '#search', function(){
        location.href = "/search/" + $('#query').val() + "/";
    });
</script>
@endsection
