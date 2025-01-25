<!DOCTYPE html>
<html lang="en">

<head>
    @include('component.head')
</head>

<body class="animsition">
    <div class="page-wrapper">

        <!-- END HEADER MOBILE-->
        @include('component.header')

        <!-- MENU SIDEBAR-->
        @include('component.sidepanel')
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        @yield('content');
        <!-- Container for Alerts -->

    </div>
    @include('component.script')
</body>

</html>
<!-- end document-->
