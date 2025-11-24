<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Qxal Academy' }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">



    {{-- Font Awesome --}}

    {{-- Google Fonts --}}


    {{-- Base CSS --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">

    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- SOLO la parte de CSS de Vite va en el head --}}
    @vite(['resources/css/nav.css'])


</head>

<body>

    @include('components.navbar')

    <main style="margin-top: 76px;">
        {{ $slot }}
    </main>

    @include('components.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Base JS --}}
    <script src="{{ asset('js/base.js') }}"></script>

    {{-- Livewire --}}
    @livewireScripts

    {{-- Scripts personalizados --}}
    {{ $scripts ?? '' }}

    {{-- SOLO JS de Vite va al final para no romper el DOM --}}
    @vite(['resources/js/app.js'])

</body>

</html>