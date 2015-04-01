@extends('theme/main')
@section('title')
{{$query}} - Researchew
@endsection
@section('content')
<div class="am-container">
    <div class="search-result">
        <ol class="am-breadcrumb">
            <li><a href="../../">Search</a></li>
            <li class="active">Keyword: {{$query}}</li>
        </ol>
        <ul class="result">
        @foreach ($results as $result)
            <li class="am-article" data-id="{{$result['id']}}">
                <h3 class="am-article-hd">{{$result['title']}} <a href="{{$result['link'][0]['@attributes']['href']}}"> <small class="am-icon-external-link"></small></a></h3>
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
            <li class="am-pagination-prev {{$prev}}"><a href="{{$page-1}}"><span aria-hidden="true" class="am-icon-angle-left"></span> Older</a></li>
            <li class="am-pagination-next {{$next}}"><a href="{{$page+1}}">Newer <span aria-hidden="true" class="am-icon-angle-right"></span></a></li>
            </ul>
        </nav>
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
