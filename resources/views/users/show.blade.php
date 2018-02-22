@extends('layouts.app')

@section('content')
    <div>
        <h2>従業員情報</h2>
        <div class="row">
            <div class="col-md-2 text-right">所属事業所</div>
            <div class="col-md-8">
                    {!! link_to_route('offices.index', $office->name) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">アカウント名</div>
            <div class="col-md-8">{{ $user->name }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">姓</div>
            <div class="col-md-8">{{ $user->last_name }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">名</div>
            <div class="col-md-8">{{ $user->first_name }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">Eメールアドレス</div>
            <div class="col-md-8">{{ $user->email }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">1ヵ月の最大労働時間</div>
            <div class="col-md-8">{{ $user->monthly_max_workhours }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">出勤日の最大労働時間</div>
            <div class="col-md-8">{{ $user->daily_max_workhours }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">出勤日の最低労働時間</div>
            <div class="col-md-8">{{ $user->daily_min_workhours }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">権限</div>
            <div class="col-md-8">{{ $user->role }}</div>
        </div>
    </div>
    <div class="row">
    <!-- 編集は自分の時のみもしくは管理者のみ表示 -->
    @if( Auth::user()->role == 'manager' )
        {!! link_to_route('users.edit', '編集', ['id' => $user->id], ['class' => 'btn btn-success', 'role' => 'button']) !!}
    @endif
    </div>
    <div>
        <h2>出勤可能日時</h2>
        <!-- 時間わりを表示 -->
            <table class="table">
                <thead>
                    <th>曜日</th>
                    <th>出勤開始可能時間</th>
                    <th>勤務終了時間</th>
                </thead>
                <tbody>
                    @foreach ($availabilities as $availability)
                    <tr>
                        
                            <td>@include('users.weekday_conv')</td>
                            <td>{{ $availability->start }}:00</td>
                            <td>{{ ($availability->start + $availability->hours) }}:00</td>
                            <td>
                                @if( Auth::user()->role == 'manager' )
                                    {!! link_to_route('editAvailability.get', '編集', ['id' => $availability->id], ['class' => 'btn btn-success', 'role' => 'button']) !!}
                                @endif</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    <div class="row">
    @if( Auth::user()->role == 'manager' )
        {!! link_to_route('newAvailability.get', '追加', ['id' => $user->id], ['class' => 'btn btn-success', 'role' => 'button']) !!}
    @endif
    </div>
    <div>
        <h2>今月の勤務シフト</h2>
            <table class="table">
                <thead>
                    <th>日付</th>
                    <th>曜日</th>
                    <th>勤務開始時間</th>
                    <th>勤務終了時間</th>
                </thead>
                <tbody>
                    @foreach ($shifts as $shift)
                    <tr>
                        
                            <td>{{ $shift->day }}</td>
                            <td>
                            <?php
                                //曜日の計算
                                $week_ja = [
                                  '日', //0
                                  '月', //1
                                  '火', //2
                                  '水', //3
                                  '木', //4
                                  '金', //5
                                  '土', //6
                                ];
                                
                                $timestamp = mktime(0, 0, 0, date('m'), $shift->day, date('Y'));
                                $date = date('w', $timestamp);
                                $day = $week_ja[$date];
                                
                                echo $day;
                            ?>
                            </td>
                            <td>{{ $shift->start }}:00</td>
                            <td>{{ ($shift->start + $shift->hours) }}:00</td>
                            <td>
                                @if( Auth::user()->role == 'manager' )
                                    {!! link_to_route('shift_edit.get', '編集', ['id' => $shift->id], ['class' => 'btn btn-success', 'role' => 'button']) !!}
                                @endif</td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
            @if( Auth::user()->role == 'manager' )
            {!! link_to_route('newShift.get', '追加', ['id' => $user->id], ['class' => 'btn btn-success', 'role' => 'button']) !!}
            @endif
            </div>
    </div>
@endsection