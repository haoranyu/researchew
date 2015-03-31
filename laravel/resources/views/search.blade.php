@extends('app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="../../">Search</a></li>
                <li class="active">Keyword: {{$query}}</li>
            </ol>
            <ul class="result">
            @foreach ($results as $result)
                <li class="media" data-id="{{$result['id']}}">
                    <div class="media-body">
                        <h4 class="media-heading">{{$result['title']}} <a href="{{$result['link'][0]['@attributes']['href']}}"> <span class="glyphicon glyphicon-share-alt"></span></a></h4>
                        <div class="time"><span class="glyphicon glyphicon-dashboard"></span> {{$result['published']}} <a href="{{$result['link'][0]['@attributes']['href']}}"> Go to review</a></div>
                        <ol class="author text-success">
                            <li><span class="glyphicon glyphicon-user"></span></li>
                            @foreach ($result['author'] as $author)
                                <li>{{$author['name']}}</li>
                            @endforeach
                        </ol>
                        <p>{{$result['summary']}}</p>
                    </div>
                </li>
            @endforeach
            </ul>
            <nav>
               <ul class="pager">
                <li class="previous {{$prev}}"><a href="{{$page-1}}"><span aria-hidden="true">&larr;</span> Older</a></li>
                <li class="next {{$next}}"><a href="{{$page+1}}">Newer <span aria-hidden="true">&rarr;</span></a></li>
               </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
