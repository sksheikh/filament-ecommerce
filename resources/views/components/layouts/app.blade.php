<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Nafisa Mart' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles()
    </head>
    <body class="bg-slate-200 dark:bg-slate-900">
        @livewire('partials.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScripts()
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            window.addEventListener('toast', event => {
                 let detail = Array.isArray(event.detail) ? event.detail[0] : event.detail;
                console.log(detail);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: detail.icon,
                    title: detail.message,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
            });
        </script>

    </body>
</html>
