<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center">
    <div class="bg-white dark:bg-surface-container-low-dark rounded-2xl shadow-xl p-8 w-full max-w-md">
        @yield('content')
    </div>
</body>

</html>
