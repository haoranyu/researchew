@extends('theme/main')
@section('content')
<div class="am-container">
    <div class="search-box">
        <h1>Researchew</h1>
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
