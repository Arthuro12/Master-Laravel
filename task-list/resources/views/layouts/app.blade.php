<!DOCTYPE html>
<html>

<head>
<title>Task List App</title>
<style>@yield("styles")</style>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">

<h1 class="text-2xl mb-4">@yield("title")</h1>
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