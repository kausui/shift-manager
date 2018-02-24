@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <h2>{{ $year }}年{{ $month }}月の勤務表</h2>
        <?php
            //前月と翌月の計算
            
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
            
            //セルの色ぬりように今日の年月日を取得
            $this_year = date('Y');
            $this_month = date('n');
            $this_day = date('d');
            
            //表示している年月のシフト表が今月のものかどうかの判定
            if( $this_year == $year && $this_month == $month)
            {
                $current_cal = True;
            } else {
                $current_cal = False;
            }
        ?>
        {!! link_to_route('shifts_year_month.get', '<', ['year' => $prev_year, 'month' => $prev_month], null) !!}
        {!! link_to_route('shifts_year_month.get', '>', ['year' => $next_year, 'month' => $next_month], null) !!}
            <!-- 時間わりを表示 -->
            <table class="table table-bordered">
                <thead>
                    @include('shifts.days')
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th>{!! link_to_route('users.show', $user->last_name." ".$user->first_name, $user->id , null) !!}</th>
                            @for ($i = 1; $i <= $last_day; $i++)
                            <?php
                            //本日だったら黄色くする
                                if( $current_cal && $this_day == $i) {
                            ?><td class="warning text-center">
                            <?php
                                } else {
                                    ?><td class="text-center">
                                        <?php
                                }
                                ?>
                                @foreach ($shifts as $shift)
                                    @if( $shift->user_id == $user->id )
                                        @if( $shift->day == $i )
                                            {!! link_to_route('shift_edit.get', "$shift->start".":00~".($shift->start+$shift->hours).":00", ['id' => $shift->id], null) !!}
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <div class="row">
            <!-- 編集は管理者のみ表示 -->
            @if( Auth::user()->role == 'manager' )
                {!! link_to_route('shifts_year_month_edit.get', '編集（未実装）', ['year' => $year, 'month' => $month], ['class' => 'btn btn-success', 'role' => 'button']) !!}
                {!! link_to_route('shifts_year_month_generate.get', 'シフト自動生成（未実装）', ['year' => $year, 'month' => $month], ['class' => 'btn btn-success', 'role' => 'button']) !!}
            @endif
            
        </div>
    </div>
    
@endsection