<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta')
</head>
<body>
    @include('partials.header')

    <div class="container">
        @yield('main')
    </div>

    @include('partials.footer')
</body>
</html>
