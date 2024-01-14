<!DOCTYPE html>
<html>

<head>
<title>Task List App</title>
<style>@yield("styles")</style>
</head>

<body>

<h1>@yield("title")</h1>
<div>
    @if(session()->has("SUCCESS"))
        <div>
            {{ session("SUCCESS") }}
        </div>
    @endif
    @yield("content")
</div>

</body>

</html>