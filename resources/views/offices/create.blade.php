@extends('layouts.app')

@section('content')
    <div class="user-profile">
        {!! Form::open( ['route' => ['offices.store', Auth::user()->id], 'method' => 'post']) !!}
        <div class="row">
            <div class="col-md-2 text-right">{!! Form::label('name', '所属事業所:') !!}</div>
            <div class="col-md-8">{!! Form::text('name') !!}</div>
        </div>
        <h2>時間ごとの必要従業員数</h2>
        <div class="row">
            <!-- 時間わりを表示 -->
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>0</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>月</th>
                        <td>Hanako</td>
                        <td>Qita</td>
                        <td>@Hanaq</td>
                    </tr>
                    <tr>
                        <th>火</th>
                        <td>Taro</td>
                        <td>Qita</td>
                        <td>@TaroQ</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <!-- 編集は自分の時のみもしくは管理者のみ表示 -->
            {!! link_to_route('users.show', 'キャンセル', ['id' => Auth::user()->id], ['class' => 'btn btn-danger', 'role' => 'button']) !!}
            {!! Form::submit('保存', ['class' => 'btn btn-success', 'role' => 'button']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    
@endsection