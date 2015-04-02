@extends('theme/main')
@section('title')
Login - Researchew
@endsection
@section('content')
<div class="am-container">
    <div class="am-u-sm-8 am-u-sm-centered">
        @if(Session::has('message'))
        <div class="am-alert am-alert-success" data-am-alert>{{ Session::get('message') }}</div>
        @endif
        <div class="am-panel am-panel-default">
            <div class="am-panel-hd">Login</div>
            <div class="am-panel-bd">
                {{ Form::open(array('url'=>'user/auth', 'class'=>'am-form')) }}
                    <div class="am-form-group">
                      <label for="email">Email</label>
                      {{ Form::text('email', null, array('class'=>'', 'placeholder'=>'Please type in your account email')) }}
                    </div>
                    <div class="am-form-group">
                        <label for="password">Password</label>
                        {{ Form::password('password', array('class'=>'', 'placeholder'=>'Please type in your password')) }}
                    </div>
                    <button type="submit" class="am-btn am-btn-primary am-btn-block">Submit</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
