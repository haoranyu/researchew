@extends('theme/main')
@section('title')
Researchew
@endsection
@section('content')
<div class="am-container">
    <div class="search-box am-u-md-10 am-u-md-centered am-u-sm-12">
        @if(Session::has('message'))
        <div class="am-alert am-alert-success" data-am-alert>
            {{ Session::get('message') }}
        </div>
        @endif
        <h1>
            <span class="am-text-secondary">Resear</span><span class="am-text-success">ch</span><span class="am-text-success">ew</span>
        </h1>
        <p>Find some research interest you have here...</p>
        <div class="am-input-group am-input-group-lg">
            <input type="text" id="query" class="am-form-field" placeholder="Type in the keyword">
            <span class="am-input-group-btn">
                <a class="am-btn am-btn-primary" id="search"> Search </a>
            </span>
        </div>
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
