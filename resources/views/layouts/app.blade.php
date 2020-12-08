<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
        @stack('page-css')
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-wrap">
            @include('includes.sidebar')
      
            <div class="w-full bg-gray-100 pl-0 lg:pl-64 min-h-screen">
      
                @include('includes.navbar')

                <main>
                    <div class="p-6 bg-gray-100">
                        @yield('page-content')
                    </div>  
                </main>
            </div>
        </div>
        @livewireScripts
        @stack('page-js')
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
