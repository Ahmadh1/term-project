<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/snackbar.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/atom-one-dark.min.css">
    <style>
        a{ color: #000; }
        a:hover{ text-decoration: none; }
        .search{ border: 1px solid #673AB7 !important; border-radius: 0 !important; }
        .panel{border:1px solid #673AB7;}
        .list-group-item a{ color: #673AB7 !important; }
        .list-group-item {border: 1px solid #673AB7 !important;}
    </style>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Forum</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li>
                        @if (Route::has('register'))
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="width: 35px; height: 35px; border-radius: 50%;">&nbsp;&nbsp;{{ Auth::user()->name }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile') }}"><i class="fa fa-user-o"></i>&nbsp;profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                 <i class="fa fa-lg fa-sign-out"></i>&nbsp;{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
    @if ($errors->count() > 0)
    <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item text-center text-danger">{{ $error }}</li>
            @endforeach
        </ul>
        <br>
        <br>
        <br>
    @endif
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form action="/result" method="GET">
                <div class="form-group">
                    <input type="search" placeholder="Type and hit Enter..." class="form-control search" name="query">
                </div>
            </form>
            <a href="{{ route('discussions.create') }}" class="form-control btn btn-default">Create a new discussion</a>
            <br>
            <br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('forum') }}">Home</a>
                        </li>
                        @if (Auth::check())
                        <li class="list-group-item">
                            <a href="/forum?filter=me">My Discussions</a>
                        </li>
                            @if (Auth::user()->admin)
                                <li class="list-group-item">
                                    <a href="{{ route('channels.index') }}">Channels</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('channels.create') }}">Add new channels</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Channels</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach ($channels as $channel)
                            <li class="list-group-item"><a href="{{ route('channel',['slug' => $channel->slug] ) }}">{{ $channel->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @yield('content')      
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/snackbar.min.js') }}"></script>
<script>
    @yield('notification-js')
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</html>
