<!doctype html>
<html lang="en">
<head>
    @include('partials.meta')
</head>
<body>
<div class="container">
    @include('partials.header')

    <div class="row">
        <div class="col-md-12">
            @yield('main')
        </div>
    </div>

    @include('partials.footer')
</div>
</body>
</html>
