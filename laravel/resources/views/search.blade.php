@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <ul>
            @foreach ($results as $result)
                <li>
                    <h3>
                        <?=$result->title?>

                    </h3>
                    <a href="{{$result->link}}"> <span class="glyphicon glyphicon-share-alt"></span> Paper resouce link</a>
                    <p><?=$result->abstract?></p>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
