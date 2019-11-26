@php
    isset($q) ? '' : $q = '';
    isset($seo) ? '' : $seo = 'false';
    isset($a11y) ? '' : $a11y = 'false';
    isset($perf) ? '' : $perf = 'false';
    isset($monitor) ? '' : $monitor = 'false';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts/head')
    <body class="flex flex-col text-gray-200 bg-gray-900 font-body lg:flex-row">
        @include('layouts/navigation')
        <main class="relative w-full px-4 pt-8 pb-6 lg:pl-container lg:pr-16">
            @yield('content')
        </main>
    </body>

    @include('layouts/scripts');
</html>
