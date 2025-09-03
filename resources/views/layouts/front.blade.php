<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Electrolize&display=swap" rel="stylesheet">
    <title>@yield('title', 'Sports Online')</title>
</head>

<body>
    @include('partials.nav')

    <main class="layout_front">
    
        @yield('content')

    </main>

    @include('partials.footer')
     
    <script>
        document.onmousemove = e => {
                document.querySelector('.layout_front').style.setProperty('--mouse-x', e.clientX + 'px');
                document.querySelector('.layout_front').style.setProperty('--mouse-y', e.clientY + 'px');
        }
    </script>
</body>

</html>