<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>SiCekam</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<style>
    ::-webkit-scrollbar {
        display: none
    }
</style>

<body class="bg-gray-100 h-screen overflow-x-hidden">
    <div class="flex h-screen">
        @include('components.sidebar-admin')

        <main class="flex-1 overflow-auto">
            @yield('content')
        </main>
    </div>
</body>

</html>
