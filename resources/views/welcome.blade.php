@extends('layouts.app')

@section('cover')
    <div class="cover">
        <div class="cover-inner">
            <div class="cover-contents">
                <h1>Shift Managerはスタッフのシフトを自動で作成するサービスです。</h1>
                <?php
                    $year = date('Y');
                    $month = date('n');
                ?>
                @if (!Auth::check())
                    <a href="{{ route('signup.get') }}" class="btn btn-success btn-lg">シフト管理を始める</a>
                @else
                    <a href="{{ action('ShiftsController@shifts_year_month', [$year, $month]) }}" class="btn btn-primary btn-lg">今月のシフトを確認</a>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('content')

@endsection