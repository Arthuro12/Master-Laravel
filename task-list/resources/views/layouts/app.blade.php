<!DOCTYPE html>
<html>

<head>
<title>Task List App</title>
<style>@yield("styles")</style>
<script src="https://cdn.tailwindcss.com"></script>

<style type="text/tailwindcss">
    .btn {
        @apply rounded-md px-2 py-1 text-center font-medium shadow-sm ring-1 ring-slate-500 hover:bg-slate-50 text-slate-500
    }
</style>
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