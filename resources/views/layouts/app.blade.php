<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="{{ asset('vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
</head>

<body class="font-sans antialiased">

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container">
            <div data-aos="fade-in">
                <div class="hero-logo">
                    <img class="" src="{{ asset('images/logo.png') }}" alt="Imperial">
                </div>

                <h1>Bienvenu dans espace PN </h1>
                <h2>MENU <span class="typed"
                        data-typed-items="Consultation de programme d'un PN, Gestion des demandes, suivi des reserves, suivi des open-time, Gestion des notes services"></span>
                </h2>

            </div>
        </div>
    </section><!-- End Hero -->
    @include('layouts.navigation')
    <!-- Page Heading -->


    <!-- Page Content -->
    <main class="main">
        <div class="container my-5">
            {{ $slot }}
        </div>
    </main>

    <script src="{{ asset('vendor/typed.js/typed.min.js') }}"></script>
    <script>
        /**
         * Hero type effect
         */
        /**
         * Easy selector helper function
         */
        const select = (el, all = false) => {
            el = el.trim()
            if (all) {
                return [...document.querySelectorAll(el)]
            } else {
                return document.querySelector(el)
            }
        }

        const typed = select('.typed')
        if (typed) {
            let typed_strings = typed.getAttribute('data-typed-items')
            typed_strings = typed_strings.split(',')
            new Typed('.typed', {
                strings: typed_strings,
                loop: true,
                typeSpeed: 100,
                backSpeed: 50,
                backDelay: 2000
            });
        }
    </script>

</body>

</html>
