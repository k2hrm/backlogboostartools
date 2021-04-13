<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
    <title>@yield('title') | {{ config('app.title') }}</title>
    @else
    <title>{{ config('app.title') }}</title>
    @endif

    @hasSection('description')
    <meta name="description" content="@yield('description')">
    @else
    <meta name="description" content="backlogの業務効率化ツールなどを提供しています">
    @endif

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap-4.4.1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script type="text/javascript">
        function check() {
            if (window.confirm('送信してよろしいですか？')) { // 確認ダイアログを表示
                return true; // 「OK」時は送信を実行
            } else { // 「キャンセル」時の処理
                window.alert('キャンセルされました'); // 警告ダイアログを表示
                return false; // 送信を中止
            }
        }
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @if (! request()->is('/') )
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/img/booster_s.png') }}" style="margin-right: 8px;" />
                </a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (! request()->is('/') )
                        <li>@if(request()->is('aggregate') )期間集計ツール@else<a href="{{ url('/aggregate') }}">期間集計ツール</a> @endif</li>
                        <li>@if(request()->is('send'))一斉送信ツール@else<a href="{{ url('/send') }}">一斉送信ツール</a>@endif</li>
                        <li>@if(request()->is('dailyreport'))日報作成ツール@else<a href="{{ url('/dailyreport') }}">日報作成ツール</a>@endif</li>
                        <li>@if(request()->is('settings'))設定@else<a href="{{ url('/settings') }}">設定</a>@endif</li>
                        <li>@if(request()->is('manuals'))マニュアル@else<a href="{{ url('/manuals') }}">マニュアル</a>@endif</li>
                        <li>@if(request()->is('contact'))お問い合わせ@else<a href="{{ url('/contact') }}">お問い合わせ</a>@endif</li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>