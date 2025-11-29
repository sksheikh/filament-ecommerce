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
            @session('success')
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4 mx-auto max-w-3xl" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endsession

            @session('error')
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-4 mx-auto max-w-3xl" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endsession

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
