@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <h2>{{ $year }}年{{ $month }}月の勤務表</h2>
        <!-- 前月と翌月の計算 -->
        <?php
            $prev_year = $year;
            $prev_month = $month - 1;
            if ($prev_month == 0)
            {
                $prev_year = $year - 1;
                $prev_month = 12;
            }
            
            $next_year = $year;
            $next_month = $month + 1;
            
            if ($next_month == 13)
            {
                $next_year = $year + 1;
                $next_month = 1;
            }
        ?>
        {!! link_to_route('shifts_year_month.get', '<', ['year' => $prev_year, 'month' => $prev_month], null) !!}
        {!! link_to_route('shifts_year_month.get', '>', ['year' => $next_year, 'month' => $next_month], null) !!}
            <!-- 時間わりを表示 -->
            <table class="table">
                <thead>
                    @include('shifts.days')
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{!! link_to_route('users.show', $user->last_name, $user->id , null) !!}</th>
                            @for ($i = 1; $i <= $last_day; $i++)
                            <!-- シフトの表示。もっとダイレクトに条件を指定する方法を探す -->
                            <th>
                                @foreach ($shifts as $shift)
                                    @if( $shift->user_id == $user->id )
                                        @if( $shift->day == $i )
                                            {{ $shift->start }}:00 ~ {{ $shift->start+$shift->hours }}:00
                                        @endif
                                    @endif
                                @endforeach
                            </th>
                        @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <div class="row">
            <!-- 編集は管理者のみ表示 -->
            @if( Auth::user()->role == 'manager' )
                {!! link_to_route('shifts_year_month_edit.get', '編集', ['year' => $year, 'month' => $month], ['class' => 'btn btn-success', 'role' => 'button']) !!}
            @endif
        </div>
    </div>
    
@endsection