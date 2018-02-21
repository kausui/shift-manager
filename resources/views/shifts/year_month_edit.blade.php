@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <h2>{{ $year }}年{{ $month }}月の勤務表の編集</h2>
            <!-- 時間わりを表示 -->
            {!! Form::open(['route' => ['shifts_year_month_update.put'], 'method' => 'put']) !!}
            <table class="table">
                <thead>
                    @include('shifts.days')
                </thead>
                <tbody>
                    
                    @foreach ($users as $user)
                        <tr>
                            <th>{{ $user->last_name }}</th>
                            @for ($i = 1; $i <= $last_day; $i++)
                            <!-- シフトの表示。もっとダイレクトに条件を指定する方法を探す -->
                            <th>
                                @foreach ($shifts as $shift)
                                    @if( $shift->user_id == $user->id )
                                        @if( $shift->day == $i )
                                            {{ $shift->start }}:00 ~ {{ $shift->hours }}時間
                                        @endif
                                    @endif
                                @endforeach
                                
                                    <div class="form-group">
                                        {!! Form::label($user->id.'_'.$year.'_'.$month.'_'.$i.'_start', '勤務開始') !!}
                                        {!! Form::select( $user->id.'_'.$year.'_'.$month.'_'.$i.'_start', ['0' => '0:00', '1' => '1:00', '2' => '2:00', '3' => '3:00', '4' => '4:00', '5' => '5:00', '6' => '6:00', '7' => '7:00', '8' => '8:00', '9' => '9:00', '10' => '10:00', '11' => '11:00', '12' => '12:00', '13' => '13:00', '14' => '14:00', '15' => '15:00', '16' => '16:00', '17' => '17:00', '18' => '18:00', '19' => '19:00', '20' => '20:00', '21' => '21:00', '22' => '22:00', '23' => '23:00'], null , ['placeholder' => '', 'class' => 'form-control']) !!}
                                    </div>
                                    〜
                                    <div class="form-group">
                                        {!! Form::label($user->id.'_'.$year.'_'.$month.'_'.$i.'_end', '勤務終了') !!}
                                        {!! Form::select($user->id.'_'.$year.'_'.$month.'_'.$i.'_end', ['0' => '0:00', '1' => '1:00', '2' => '2:00', '3' => '3:00', '4' => '4:00', '5' => '5:00', '6' => '6:00', '7' => '7:00', '8' => '8:00', '9' => '9:00', '10' => '10:00', '11' => '11:00', '12' => '12:00', '13' => '13:00', '14' => '14:00', '15' => '15:00', '16' => '16:00', '17' => '17:00', '18' => '18:00', '19' => '19:00', '20' => '20:00', '21' => '21:00', '22' => '22:00', '23' => '23:00', '24' => '24:00'], null , ['placeholder' => '', 'class' => 'form-control']) !!}
                                    </div>
                
                                    <div class="text-right">
                                        
                                    </div>
                                
                            </th>
                        @endfor
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            {!! Form::close() !!}
            {!! Form::submit('登録する', ['class' => 'btn btn-success']) !!}
        <div class="row">
            <!-- 編集は管理者のみ表示 -->
            @if( Auth::user()->role == 'manager' )
                {!! link_to_route('shifts_year_month.get', 'キャンセル', ['year' => $year, 'month' => $month], ['class' => 'btn btn-success', 'role' => 'button']) !!}
            @endif
        </div>
    </div>
    
@endsection