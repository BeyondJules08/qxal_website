<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Qxal Academy' }}</title>
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.png" type="image/png">
<link rel="shortcut icon" href="/favicon.ico">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">



    {{-- Font Awesome --}}

    {{-- Google Fonts --}}


    {{-- Base CSS --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">

    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- SOLO la parte de CSS de Vite va en el head --}}
    @vite(['resources/css/nav.css'])


</head>
<style>
:root {
    --primary-color: #ff6b6b;
    --secondary-color: #4ecdc4;
    --accent-color: #45b7d1;
    --warning-color: #ffa726;
    --success-color: #66bb6a;
    --text-dark: #2c3e50;
}

body {
    font-family: "Fredoka", sans-serif;
    color: var(--text-dark);
}

.cursor-trail {
    position: fixed;
    pointer-events: none;
    border-radius: 50%;
    background: radial-gradient(circle, #ff6b6b, transparent);
    z-index: 9999;
}

.navbar-brand {
    font-weight: 700;
    font-size: 2rem;
    color: var(--primary-color) !important;
}

.btn-primary {
    background: linear-gradient(
        135deg,
        var(--primary-color),
        var(--accent-color)
    );
    border: none;
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 500;
    transition: transform 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.feature-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    overflow: hidden;
}

/* Estilos para formulario de contacto */
.custom-alert {
    border-radius: 15px;
    border: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: slideDown 0.3s ease;
}

.custom-alert i {
    font-size: 1.2rem;
}

.custom-alert .btn-close {
    margin-left: auto;
    background: none;
    border: none;
    font-size: 1.2rem;
    opacity: 0.7;
    cursor: pointer;
}

.custom-alert .btn-close:hover {
    opacity: 1;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-control.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.feature-card:hover {
    transform: translateY(-10px);
}

.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 100px 0;
}

.stats-section {
    background: var(--secondary-color);
    color: white;
}

.floating-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

.shape {
    position: absolute;
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%,
    100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

.testimonial-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
}
/* Estilos de validación */
.form-control.is-invalid,
.form-select.is-invalid {
    border-color: #dc3545;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath fill='%23dc3545' d='M6.8 3.5H5.2V6h1.6zm0 2.6H5.2v1.6h1.6z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    padding-right: calc(1.5em + 0.75rem);
}

.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #dc3545;
}

.form-control.is-invalid:focus ~ .invalid-feedback,
.form-select.is-invalid:focus ~ .invalid-feedback {
    display: block;
}

.invalid-feedback.d-block {
    display: block;
}

/* Animación de entrada para errores */
.invalid-feedback {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Estilos para campos con error */
.form-control.is-invalid::placeholder,
.form-select.is-invalid::placeholder {
    color: #dc3545;
    opacity: 0.7;
}
/* Evitar que textos largos rompan el diseño */
.testimonial-card p,
.testimonial-card .testimonial-text {
    overflow-wrap: break-word;
    word-break: break-word;
    hyphens: auto;
}

</style>
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
