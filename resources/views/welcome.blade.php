@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>Shift Managerはスタッフのシフトを自動で作成するサービスです。</h1>
                @if (!Auth::check())
                    <a href="{{ route('signup.get') }}" class="btn btn-success btn-lg">シフト管理を始める</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')

@endsection