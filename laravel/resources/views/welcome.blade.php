@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="jumbotron text-center" action="/s">
                <h1>Researchew</h1>
                <p class="text-muted">Find some research interest you have here...</p>
                <div class="input-group input-group-lg">

                    <input type="text" name="q" class="form-control" placeholder="Type in the keyword">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary"> Search </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
