<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="/">Shift Manager</a></li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('offices.index') }}">事業所情報</a>
                                </li>
                                <?php
                                        $year = date('Y');
                                        $month = date('n');
                                    ?>
                                <li>
                                    
                                    <a href="{{ action('ShiftsController@shifts_year_month', [$year, $month]) }}">今月のシフト</a>
                                </li>
                                <li>
                                    <a href="{{ route('users.show', Auth::user()->id) }}">マイページ</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{ route('logout.get') }}">ログアウト</a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('signup.get') }}">新規登録</a></li>
                        <li><a href="{{ route('login.get') }}">ログイン</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>