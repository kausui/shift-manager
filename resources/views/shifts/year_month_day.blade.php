@extends('layouts.app')

@section('content')
    <div>
        <h2>{{ $year }}年{{ $month }}月{{ $day }}日({{ $weekday}})の勤務表</h2>
        <!-- 前日と翌日の計算 -->
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
        <!-- {!! link_to_route('shifts_year_month_day.get', '<', ['year' => $prev_year, 'month' => $prev_month], null) !!} -->
        <!-- {!! link_to_route('shifts_year_month_day.get', '>', ['year' => $next_year, 'month' => $next_month], null) !!} -->
            <!-- 時間わりを表示 -->
            <table class="table table-bordered">
                <thead>
                    <th>時間</th>
                    @for ($i = 0; $i <= 23; $i++)
                        <th class="text-center">{{ $i }}</th>
                    @endfor
                </thead>
                <tbody>
                    <tr>
                        <th>必要人数</th>
                    @foreach ($required_staff_numbers as $required_staff_number)
                        <th class="text-center">{{ $required_staff_number->number }}</th>
                    @endforeach
                    </tr>
                    <tr>
                        <th>過不足人数</th>
                        <!-- あらかじめControllerで出しておいた方がいい -->
                    @foreach ($husoku as $h)
                        @if( $h >= 0 )
                            <th class="text-center">{{ $h }}</th>
                        @else
                            <th class="text-center husoku_warning">{{ $h }}</th>
                        @endif
                    @endforeach
                    </tr>
                    <!-- シフトの表示。もっとダイレクトに条件を指定する方法を探す -->
                    @foreach ($users as $user)
                        <tr>
                            <th>{!! link_to_route('users.show', $user->last_name." ".$user->first_name, $user->id , null) !!}</th>
                            @for ($i = 0; $i <= 23; $i++)
                            <td class="text-center">
                                @foreach ($shifts as $shift)
                                    @if( $shift->user_id == $user->id )
                                        @if( $i >= $shift->start )
                                            @if( ($shift->start + $shift->hours) > $i )
                                                出
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    
@endsection