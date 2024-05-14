<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('section.head')

</head>
<body>
  
    @include('section.header')
    @include('section.sidebar')
    <div id="loader" class="loader-wrapper">
        <div class="loader"></div>
    </div>
    @yield('content')
    @include('section.footer')
    @include('section.scripts')

</body>
</html>
