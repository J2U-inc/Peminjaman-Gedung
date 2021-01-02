<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url({{asset('gambar/uin.jpg')}});
                background-repeat: no-repeat;
                background-size: cover;
                /* background-color: #fff; */
                /* color: #000000; */
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                /* color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;*/
                text-transform: uppercase;
                margin-top: 2%;
                width: 100px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .parent {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: 1fr 6fr;
                grid-column-gap: 0px;
                grid-row-gap: 0px;
                height: 100%;
                width: 100%;
            }
            .logo{
                margin: 2%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="parent">
                <div class="logo row">
                    <div class="col-1">
                        <img src="{{asset('gambar/logo uin.png')}}" alt="logo" width="80px">
                    </div>
                    <div class="col-9 ml-5">
                        <h3><strong>Sistem Peminjaman Gedung</strong></h3>
                        <h3><strong>UIN SUSKA RIAU</strong></h3>
                    </div>
                </div>
                <div>
                </div>
                <div>
                </div>
                {{-- <div style="background-color: brown">
                    b
                </div>
                <div style="background-color: chartreuse">
                    c
                </div>
                <div style="background-color: cyan">
                    d
                </div> --}}
            </div>
        </div>
    </body>
</html>
