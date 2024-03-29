@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-offset-3 col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">{!! Auth::user()->office->name !!}の従業員登録</div>
            <div class="panel-body">
                {!! Form::open(['route' => ['users.store', Auth::user()->office_id], 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'お名前') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'パスワード（確認）') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>

                    <div class="buttons text-right">
                        {!! Form::submit('登録', ['class' => 'btn btn-success pull-left']) !!}
                        
                        @include('commons.button_cancel')
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection