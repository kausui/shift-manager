@extends('layouts.app')

@section('content')
    <div>
        <h2>従業員情報編集</h2>
        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
        <div class="row">
            <!-- アカウント名はやっぱり編集できないようにする -->
            <div class="col-md-2 text-right">{!! Form::label('name', 'アカウント名:') !!}</div>
            <div class="col-md-8">{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">{!! Form::label('last_name', '姓:') !!}</div>
            <div class="col-md-8">{!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">{!! Form::label('first_name', '名:') !!}</div>
            <div class="col-md-8">{!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">{!! Form::label('email', 'Eメールアドレス:') !!}</div>
            <div class="col-md-8">{!! Form::text('email', $user->email, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">{!! Form::label('monthly_max_workhours', '1ヵ月の最大労働時間:') !!}</div>
            <div class="col-md-8">{!! Form::number('monthly_max_workhours', $user->monthly_max_workhours, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">{!! Form::label('daily_max_workhours', '出勤日の最大労働時間:') !!}</div>
            <div class="col-md-8">{!! Form::number('daily_max_workhours', $user->daily_max_workhours, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">{!! Form::label('daily_mim_workhours', '出勤日の最低労働時間:') !!}</div>
            <div class="col-md-8">{!! Form::number('daily_min_workhours', $user->daily_min_workhours, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">{!! Form::label('role', '権限:') !!}</div>
            <div class="col-md-8">{!! Form::select('role', ['manager' => 'Manager', 'viewer' => 'Viewer'], $user->role, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">
            <!-- 編集は自分の時のみもしくは管理者のみ表示 -->
            {!! link_to_route('users.show', 'キャンセル', ['id' => $user->id,], ['class' => 'btn btn-danger', 'role' => 'button']) !!}
            {!! Form::submit('更新', ['class' => 'btn btn-success', 'role' => 'button']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    
@endsection