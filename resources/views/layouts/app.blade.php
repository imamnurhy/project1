<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/myStyle.css') }}">
    @yield('style')
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }

        .thumb-image {
            width: 25%;
            height: 25%;
        }
    </style>
</head>

<body class="light">
    <!-- Pre loader -->
    <div id="loader" class="loader">
        <div class="plane-container">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
            <section class="sidebar">
                <div class="w-80px mt-3 mb-3 ml-3">
                    <img src="{{ asset('assets/img/basic/logo.png')}}" alt="">
                </div>
                <div class="relative">
                    <div class="user-panel p-3 light mb-2">
                        <div>
                            <div class="float-left image">
                                <img class="user_avatar" src="{{ asset('assets/img/dummy/u2.png')}}" alt="User Image">
                            </div>
                            <div class="float-left info">
                                <h6 class="font-weight-light mt-2 mb-1">{{ Auth::user()->username }}</h6>
                                <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                {{-- Sidebar --}}
                @include('layouts._navigation')

            </section>
        </aside>
        <!--Sidebar End-->
        <div class="has-sidebar-left">
            <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                        <div class="search-bar">
                            <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50"
                                type="text" placeholder="start typing...">
                        </div>
                        <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent"
                            aria-expanded="false" aria-label="Toggle navigation"
                            class="paper-nav-toggle paper-nav-white active "><i></i></a>
                    </div>
                </div>
            </div>
            <div class="sticky">
                <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
                    <!-- <div class="navbar navbar-expand d-flex justify-content-between bd-navbar white shadow"> -->
                    <div class="relative">
                        <div class="d-flex">
                            <div>
                                <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                                    <i></i>
                                </a>
                            </div>

                            @if(Auth::user()->pegawai)
                            <div class="d-none d-md-block">
                                <h1 class="nav-title text-white">Login Sebagai {{ Auth::user()->pegawai->n_pegawai }}
                                </h1>
                            </div>
                            @endif

                        </div>
                    </div>
                    <!--Top Menu Start -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown custom-dropdown user user-menu ">
                                <a href="#" class="nav-link" data-toggle="dropdown">
                                    @if(Auth::user()->pegawai)
                                    <img src="{{ Auth::user()->pegawai->foto == '' ? asset('assets/img/dummy/u1.png') : env('SFTP_SRC').'foto/'.Auth::user()->pegawai->foto }}"
                                        class="user-image fotoLink" alt="User Image">
                                    @else
                                    <img src="{{ asset('assets/img/dummy/u1.png') }}" class="user-image fotoLink"
                                        alt="User Image">
                                    @endif
                                    <i class="icon-more_vert "></i>
                                </a>
                                <div class="dropdown-menu p-4 dropdown-menu-right" style="width:255px">
                                    <div class="row box justify-content-between">
                                        <div class="col">
                                            <a href="{{ route('account.profile') }}">
                                                <i class="icon-user amber-text lighten-2 avatar  r-5"></i>
                                                <div class="pt-1">Profil</div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('account.password') }}">
                                                <i class="icon-user-secret pink-text lighten-1 avatar  r-5"></i>
                                                <div class="pt-1">Ganti Password</div>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                class="list-group-item list-group-item-action mt-2"><i
                                                    class="mr-2 icon-power-off text-danger"></i>Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">@csrf</form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
    <!--/#app -->
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/').'/') !!}
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/myScript.js') }}"></script>
    @yield('script')
</body>

</html>
