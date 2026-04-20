<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Siswa')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @stack('styles')
</head>
<body class="m-0 min-h-screen bg-slate-50 antialiased">
    <div class="min-h-screen">
        @yield('content')
    </div>
</body>
</html>
