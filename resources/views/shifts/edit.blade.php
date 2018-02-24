@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-offset-3 col-xs-6">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $user->name }}のシフト</div>
            <div class="panel-body">
                {!! Form::open(['route' => ['shifts_update.put', $shift->id], 'method' => 'put']) !!}
                    <div class="form-group">
                        {!! Form::label('date', '出勤日') !!}
                        {!! Form::date('date', $shift->year.'-'.str_pad($shift->month, 2, 0, STR_PAD_LEFT).'-'.str_pad($shift->day, 2, 0, STR_PAD_LEFT) , ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('start', '勤務開始時間') !!}
                        {!! Form::select('start', ['0' => '0:00', '1' => '1:00', '2' => '2:00', '3' => '3:00', '4' => '4:00', '5' => '5:00', '6' => '6:00', '7' => '7:00', '8' => '8:00', '9' => '9:00', '10' => '10:00', '11' => '11:00', '12' => '12:00', '13' => '13:00', '14' => '14:00', '15' => '15:00', '16' => '16:00', '17' => '17:00', '18' => '18:00', '19' => '19:00', '20' => '20:00', '21' => '21:00', '22' => '22:00', '23' => '23:00'], ($shift->start) , ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('end', '勤務終了時間') !!}
                        {!! Form::select('end', ['0' => '0:00', '1' => '1:00', '2' => '2:00', '3' => '3:00', '4' => '4:00', '5' => '5:00', '6' => '6:00', '7' => '7:00', '8' => '8:00', '9' => '9:00', '10' => '10:00', '11' => '11:00', '12' => '12:00', '13' => '13:00', '14' => '14:00', '15' => '15:00', '16' => '16:00', '17' => '17:00', '18' => '18:00', '19' => '19:00', '20' => '20:00', '21' => '21:00', '22' => '22:00', '23' => '23:00', '24' => '24:00'], ($shift->start + $shift->hours), ['class' => 'form-control']) !!}
                    </div>
                    <div class="buttons text-right">
                        {!! Form::submit('更新する', ['class' => 'btn btn-success pull-left']) !!}
                        
                    {!! Form::close() !!}
                    
                    @include('commons.button_cancel')
                    
                    
                    {!! Form::open(['route' => ['shifts_destroy.delete', $shift->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection