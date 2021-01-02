@extends('layouts.skeleton')
@section('app')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('navbar.topbar')
        @include('navbar.sidebar')
        @yield('main')
    </div>
</body>
@endsection
