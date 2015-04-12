@extends('theme/main')
@section('title')
Register - Researchew
@endsection
@section('content')
<div class="am-container">
    <div class="am-u-md-8 am-u-md-centered am-u-sm-12">
        @if(Session::has('message'))
        <div class="am-alert am-alert-danger" data-am-alert>
            {{ Session::get('message') }}
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="am-panel am-panel-default">
            <div class="am-panel-hd">Register</div>
            <div class="am-panel-bd">
                {{ Form::open(array('url'=>'user/create', 'class'=>'am-form')) }}
                    <div class="am-form-group">
                      <label for="name">Name</label>
                      {{ Form::text('name', null, array('class'=>'', 'placeholder'=>'Please type in your name')) }}
                    </div>
                    <div class="am-form-group">
                      <label for="email">Email</label>
                      {{ Form::text('email', null, array('class'=>'', 'placeholder'=>'Please type in the email address')) }}
                    </div>
                    <div class="am-form-group">
                        <label for="password">Password</label>
                        {{ Form::password('password', array('class'=>'', 'placeholder'=>'Please set a password')) }}
                    </div>
                    <div class="am-form-group">
                        <label for="password_confirmation">Repeat Password</label>
                        {{ Form::password('password_confirmation', array('class'=>'', 'placeholder'=>'Please repeat the password')) }}
                    </div>
                    {{ Form::submit('Submit',array('class'=>'am-btn am-btn-primary am-btn-block')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
