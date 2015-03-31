@extends('app')

@section('content')

<div class="container">
    <ol class="breadcrumb">
        <li><a href="#">Search</a></li>
        <li class="active">Keyword: {{$query}}</li>
    </ol>
    <div class="row">
        <ul>
        @foreach ($results as $result)
            <li>
                <h4>
                    {{$result['title']}}
                </h4>
                <a href="{{$result['link'][0]['@attributes']['href']}}"> <span class="glyphicon glyphicon-share-alt"></span> Paper resouce link</a>
                <p>{{$result['summary']}}</p>

            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection
