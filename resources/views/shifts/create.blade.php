@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-offset-3 col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $user->name }}の勤務シフト登録</div>
            <div class="panel-body">
                {!! Form::open(['route' => ['shifts_store.post'], 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::label('date', '出勤日') !!}
                        {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('start', '勤務開始時間') !!}
                        {!! Form::select('start', ['0' => '0:00', '1' => '1:00', '2' => '2:00', '3' => '3:00', '4' => '4:00', '5' => '5:00', '6' => '6:00', '7' => '7:00', '8' => '8:00', '9' => '9:00', '10' => '10:00', '11' => '11:00', '12' => '12:00', '13' => '13:00', '14' => '14:00', '15' => '15:00', '16' => '16:00', '17' => '17:00', '18' => '18:00', '19' => '19:00', '20' => '20:00', '21' => '21:00', '22' => '22:00', '23' => '23:00'], '0:00', ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('end', '勤務終了時間') !!}
                        {!! Form::select('end', ['0' => '0:00', '1' => '1:00', '2' => '2:00', '3' => '3:00', '4' => '4:00', '5' => '5:00', '6' => '6:00', '7' => '7:00', '8' => '8:00', '9' => '9:00', '10' => '10:00', '11' => '11:00', '12' => '12:00', '13' => '13:00', '14' => '14:00', '15' => '15:00', '16' => '16:00', '17' => '17:00', '18' => '18:00', '19' => '19:00', '20' => '20:00', '21' => '21:00', '22' => '22:00', '23' => '23:00', '24' => '24:00'], '0:00', ['class' => 'form-control']) !!}
                    </div>

                    <div class="buttons text-right">
                        {!! Form::hidden('user_id', $user->id) !!}
                        {!! Form::submit('登録', ['class' => 'btn btn-success pull-left']) !!}
                        
                        @include('commons.button_cancel')
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection