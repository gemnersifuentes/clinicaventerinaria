<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('scoobydoo.layouts.partials.css')
    @include('scoobydoo.layouts.partials.loader')
</head>
<body>
    <div id="content" style="display: none;">
    @include('scoobydoo.layouts.partials.header')
        @yield('content')
             

@include('scoobydoo.layouts.partials.footer')
    </div>
</body>
</html>