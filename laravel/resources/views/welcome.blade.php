@extends('app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="jumbotron text-center">
                <h1>Researchew</h1>
                <p class="text-muted">Find some research interest you have here...</p>
                <div class="input-group input-group-lg">
                    <input type="text" id="query" class="form-control" placeholder="Type in the keyword">
                    <span class="input-group-btn">
                        <a class="btn btn-primary" id="search"> Search </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).on('click', '#search', function(){
        location.href = "/search/" + $('#query').val();
    });
</script>
@endsection
