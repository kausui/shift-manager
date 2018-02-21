@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="row">
            <div class="col-md-2 text-right">事業所名:</div>
            <div class="col-md-8">{{ $office->name }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">1週間に必要な人時:</div>
            <div class="col-md-8">{{ $required_man_hours }}</div>
        </div>
        <div class="row">
            <div class="col-md-2 text-right">現在の人時:</div>
            <div class="col-md-8">{{ $current_man_hours }}</div>
        </div>
        <h2>時間ごとの必要従業員数</h2>
            <!-- 時間わりを表示 -->
            <table class="table">
                <thead>
                    @include('offices.time')
                </thead>
                <tbody>
                    <tr>
                        <th>月</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Mon')
                                <td>{{ $required_staff_number->number }}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>火</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Tue')
                                <td>{{ $required_staff_number->number }}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>水</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Wed')
                                <td>{{ $required_staff_number->number }}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>木</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Thu')
                                <td>{{ $required_staff_number->number }}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>金</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Fri')
                                <td>{{ $required_staff_number->number }}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>土</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Sat')
                                <td>{{ $required_staff_number->number }}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>日</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Sun')
                                <td>{{ $required_staff_number->number }}</td>
                            @endif
                        @endforeach
                    </tr>
                </tbody>
            </table>
        {!! $required_staff_numbers->render() !!}
        <div class="row">
            <!-- 編集は管理者のみ表示 -->
            @if( Auth::user()->role == 'manager' )
                {!! link_to_route('offices.edit', '編集', ['id' => $office->id], ['class' => 'btn btn-success', 'role' => 'button']) !!}
            @endif
        </div>
        <div>
            <h2>従業員一覧</h2>
            <table class="table">
                <thead>
                    <th>アカウント名</th>
                    <th>姓</th>
                    <th>名</th>
                    <th>Eメールアドレス</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} </td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <!-- 編集は管理者のみ表示 -->
            @if( Auth::user()->role == 'manager' )
                {!! link_to_route('users.create', '従業員登録', [], ['class' => 'btn btn-success', 'role' => 'button']) !!}
            @endif
        </div>
    </div>
    
@endsection