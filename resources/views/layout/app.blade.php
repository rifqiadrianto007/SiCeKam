<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/png">
    <title>SiCekam</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>
</head>

<style>
    ::-webkit-scrollbar{
        display: none
    }
</style>

<body class="bg-gray-50 text-gray-800 font-sans scrollbar-hide">

    <main>
        @yield('content')
    </main>

</body>
</html>
