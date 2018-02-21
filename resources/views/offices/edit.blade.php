@extends('layouts.app')

@section('content')
    <div class="user-profile">
        {!! Form::model($office, ['route' => ['offices.update', $office->id], 'method' => 'put']) !!}
        <div class="row">
            <div class="col-md-1">{!! Form::label('name', '事業所名:') !!}</div>
            <div class="col-md-8">{!! Form::text('name', $office->name) !!}</div>
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
                                <td>{!! Form::text($required_staff_number->weekday.$required_staff_number->time, $required_staff_number->number) !!}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>火</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Tue')
                                <td>{!! Form::text($required_staff_number->weekday.$required_staff_number->time, $required_staff_number->number) !!}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>水</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Wed')
                                <td>{!! Form::text($required_staff_number->weekday.$required_staff_number->time, $required_staff_number->number) !!}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>木</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Thu')
                                <td>{!! Form::text($required_staff_number->weekday.$required_staff_number->time, $required_staff_number->number) !!}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>金</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Fri')
                                <td>{!! Form::text($required_staff_number->weekday.$required_staff_number->time, $required_staff_number->number) !!}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>土</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Sat')
                                <td>{!! Form::text($required_staff_number->weekday.$required_staff_number->time, $required_staff_number->number) !!}</td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>日</th>
                        @foreach ($required_staff_numbers as $required_staff_number)
                            @if ($required_staff_number->weekday == 'Sun')
                                <td>{!! Form::text($required_staff_number->weekday.$required_staff_number->time, $required_staff_number->number) !!}</td>
                            @endif
                        @endforeach
                    </tr>
                </tbody>
            </table>
            
        {!! $required_staff_numbers->render() !!}
        <div class="row">
            <!-- 編集は管理者のみ表示 -->
            {!! link_to_route('offices.show', 'キャンセル', ['id' => $office->id,], ['class' => 'btn btn-danger', 'role' => 'button']) !!}
            {!! Form::submit('更新', ['class' => 'btn btn-success', 'role' => 'button']) !!}
            
        </div>
        {!! Form::close() !!}
    </div>
    
@endsection