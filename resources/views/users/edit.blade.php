@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-xs-offset-3 col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">{!! $user->name !!}の情報編集</div>
                <div class="panel-body">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                    <div class="form-group">
                        <!-- アカウント名はやっぱり編集できないようにする -->
                        {!! Form::label('name', 'アカウント名:') !!}
                        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('last_name', '姓:') !!}
                        {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('first_name', '名:') !!}
                        {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Eメールアドレス:') !!}
                        {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('monthly_max_workhours', '1ヵ月の最大労働時間:') !!}
                        {!! Form::number('monthly_max_workhours', $user->monthly_max_workhours, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('daily_max_workhours', '出勤日の最大労働時間:') !!}
                        {!! Form::number('daily_max_workhours', $user->daily_max_workhours, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('daily_mim_workhours', '出勤日の最低労働時間:') !!}
                        {!! Form::number('daily_min_workhours', $user->daily_min_workhours, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('role', '権限:') !!}
                        {!! Form::select('role', ['manager' => 'Manager', 'viewer' => 'Viewer'], $user->role, ['class' => 'form-control']) !!}
                    </div>
                    <div class="buttons text-right">
                        <!-- 編集は自分の時のみもしくは管理者のみ表示 -->
                        {!! Form::submit('更新', ['class' => 'btn btn-success pull-left', 'role' => 'button']) !!}
                        @include('commons.button_cancel')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection