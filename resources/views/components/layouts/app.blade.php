<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Nafisa Mart' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
        @livewireStyles()
        <style>
            .ts-wrapper {
                border: none !important;
                padding: 0 !important;
            }
            .ts-control {
                border-radius: 0.5rem !important;
                padding: 8px 12px !important;
                border: 1px solid #d1d5db !important;
                min-height: 42px !important;
                font-size: 1rem !important;
                display: flex !important;
                align-items: center !important;
            }
            .dark .ts-control {
                background-color: #374151 !important;
                border-color: #4b5563 !important;
                color: white !important;
            }
            .dark .ts-dropdown {
                background-color: #374151 !important;
                color: white !important;
                border-color: #4b5563 !important;
            }
            .dark .ts-dropdown .active {
                background-color: #4b5563 !important;
                color: white !important;
            }
            .dark .ts-dropdown .option:hover {
                background-color: #4b5563 !important;
            }
            .ts-wrapper.focus .ts-control {
                box-shadow: 0 0 0 2px #3b82f6 !important;
                border-color: #3b82f6 !important;
            }
        </style>
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
                
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
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
