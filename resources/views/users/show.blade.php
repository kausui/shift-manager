@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="row">
            <div class="col-md-2 text-right">所属事業所</div>
            <div class="col-md-8">
                @if (isset( $office ))
                    {!! link_to_route('offices.show', $office->name, ['id' => $office->id,]) !!}
                @else
                    {!! link_to_route('offices.create', '所属事業所が設定されていません', ['id' => $user->id,]) !!}
                @endif
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
            <div class="col-md-2 text-right">権限</div>
            <div class="col-md-8">{{ $user->role }}</div>
        </div>
    </div>
    <div class="row">
    <!-- 編集は自分の時のみもしくは管理者のみ表示 -->
    {!! link_to_route('users.edit', '編集', ['id' => $user->id,], ['class' => 'btn btn-success', 'role' => 'button']) !!}
    </div>
@endsection