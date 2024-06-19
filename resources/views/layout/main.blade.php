<!DOCTYPE html>
<html lang="en">
<head>

    @include('includes.head')
    @stack('head')

</head>
<body>
    <div id="app">
        <div id="sidebar" class="active">
            @include('includes.sidebar')
        </div>
        <div id="main" class="layout-navbar">
            <header class="mb-3">
                @include('includes.header')
            </header>
            <div id="main-content">
                @yield('content')
                @include('includes.footer')
            </div>
        </div>
    </div>
    

    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- Font Awesome Icon -->
    <script src="https://kit.fontawesome.com/91441035a6.js" crossorigin="anonymous"></script>
    @stack('js')
</body>
</html>