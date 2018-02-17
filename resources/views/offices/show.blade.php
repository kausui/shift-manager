@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="row">
            <div class="col-md-2 text-right">事業所名</div>
            <div class="col-md-8">{{ $office->name }}</div>
        </div>
        <h2>時間ごとの必要従業員数</h2>
        <div class="row">
            <!-- 時間わりを表示 -->

        </div>
        <div class="row">
            <!-- 編集は管理者のみ表示 -->
            {!! link_to_route('offices.edit', '編集', ['id' => $office->id,], ['class' => 'btn btn-success', 'role' => 'button']) !!}
        </div>
    </div>
    
@endsection