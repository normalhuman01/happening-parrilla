<!DOCTYPE html>
<html lang="en">
<head>
    @yield('head')
    <title>@yield("title")</title>
</head>
<body>
    @yield("header")
    @yield("content")
    @yield("footer")
    @yield("scripts")
</body>
</html>