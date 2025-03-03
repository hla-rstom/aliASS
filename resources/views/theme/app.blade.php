<!DOCTYPE html>
<html dir="ltr" lang="en-US">
@include('theme.head')
<body>
<div class="wrapper clearfix" id="wrapper">
@include('theme.header')
@yield('content')
@include('theme.footer')
</div>
@yield('script')
</body>
</html>