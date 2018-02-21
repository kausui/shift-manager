@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-offset-3 col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $user->name }}の出勤可能日時登録</div>
            <div class="panel-body">
                {!! Form::open(['route' => ['availabilities.store'], 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::label('weekday', '出勤可能日') !!}
                        {!! Form::select('weekday', ['Mon' => '月曜日', 'Tue' => '火曜日', 'Wed' => '水曜日', 'Thu' => '木曜日', 'Fri' => '金曜日', 'Sat' => '土曜日', 'Sun' => '日曜日'], '月曜日', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('start', '勤務開始時間') !!}
                        {!! Form::select('start', ['0' => '0:00', '1' => '1:00', '2' => '2:00', '3' => '3:00', '4' => '4:00', '5' => '5:00', '6' => '6:00', '7' => '7:00', '8' => '8:00', '9' => '9:00', '10' => '10:00', '11' => '11:00', '12' => '12:00', '13' => '13:00', '14' => '14:00', '15' => '15:00', '16' => '16:00', '17' => '17:00', '18' => '18:00', '19' => '19:00', '20' => '20:00', '21' => '21:00', '22' => '22:00', '23' => '23:00'], '0:00', ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('end', '勤務終了時間') !!}
                        {!! Form::select('end', ['0' => '0:00', '1' => '1:00', '2' => '2:00', '3' => '3:00', '4' => '4:00', '5' => '5:00', '6' => '6:00', '7' => '7:00', '8' => '8:00', '9' => '9:00', '10' => '10:00', '11' => '11:00', '12' => '12:00', '13' => '13:00', '14' => '14:00', '15' => '15:00', '16' => '16:00', '17' => '17:00', '18' => '18:00', '19' => '19:00', '20' => '20:00', '21' => '21:00', '22' => '22:00', '23' => '23:00', '24' => '24:00'], '0:00', ['class' => 'form-control']) !!}
                    </div>

                    <div class="text-right">
                        {!! Form::hidden('user_id', $user->id) !!}
                        {!! Form::submit('登録する', ['class' => 'btn btn-success']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection