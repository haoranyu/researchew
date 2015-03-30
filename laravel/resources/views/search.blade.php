@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach ($results as $result)
                <p>{{ $result->title }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection
