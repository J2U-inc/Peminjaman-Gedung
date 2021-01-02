@extends('layouts.skeletonU')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('navbar.topbarU')
        @include('navbar.sidebarU')
        @yield('mainU')
    </div>
</body>
