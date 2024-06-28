<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ $title ?? 'Page' }} | {{ config('app.name') }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
        name="viewport" />

    <link rel="icon" href="{{ asset('images/company-logo.png') }}" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <script src="{{ asset('vendor/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('vendor/assets/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <link rel="stylesheet" href="{{ asset('vendor/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/assets/css/kaiadmin.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/documentation/assets/styles.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('vendor/documentation/assets/prism-normalize-whitespace.min.js') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        @livewire('components.sidebar-livewire-component')

        <div class="main-panel">
            @livewire('components.header-livewire-component')

            <div class="container">
                {{ $slot }}
            </div>

            @livewire('components.footer-livewire-component')
        </div>
    </div>

    <script src="{{ asset('vendor/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('vendor/assets/js/kaiadmin.min.js') }}"></script>
    @livewireScripts
</body>

</html>
