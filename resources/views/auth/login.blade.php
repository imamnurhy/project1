<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <title>Form Login :: Administrator</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
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
    </style>
</head>

<body class="light">
    <!-- Pre loader -->
    <div id="loader" class="loader">
        <div class="plane-container">
            <div class="preloader-wrapper small active">
                <div class="preloader-wrapper small active">
                    <div class="spinner-layer spinner-blue-only">
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
    </div>

    <div id="primary" class="blue4 p-t-b-100 height-full responsive-phone">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="assets/img/icon/icon-plane.png" alt="">
                </div>
                <div class="col-lg-6 p-t-100">
                    <div class="text-white">
                        <h1>Selamat Datang</h1>
                        <p class="s-18 p-t-b-20 font-weight-lighter">Admin BCNetwork </p>
                    </div>
                    <form method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <div class="row">

                            {{-- Username --}}
                            <div class="col-lg-6">
                                <div class="form-group has-icon"><i class="icon-user"></i>
                                    <input type="text"
                                        class="form-control form-control-lg @if ($errors->has('username')) is-invalid @endif"
                                        placeholder="Username" name="username" autocomplete="off"
                                        value="{{ old('username') }}" required autofocus>
                                    @if ($errors->has('username'))
                                    <div class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Password --}}
                            <div class="col-lg-6">
                                <div class="form-group has-icon"><i class="icon-user-secret"></i>
                                    <input type="password"
                                        class="form-control form-control-lg @if ($errors->has('password')) is-invalid @endif"
                                        placeholder="Password" name="password" autocomplete="off"
                                        value="{{ old('password') }}" required>
                                    @if ($errors->has('password'))
                                    <div class="invalid-feedback text-white" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-success btn-lg btn-block" value="login">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/').'/') !!}
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
