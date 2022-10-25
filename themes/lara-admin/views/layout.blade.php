<!doctype html>
<html lang="{{ page_lang() }}">

<head>
    <title>{{ page_title() }}</title>
    <meta name="web_url" value="{{ asset('') }}" />
    <meta name="csrf_token" value="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @livewireStyles
    {{ load_asset_local('asset_header_before') }}
    {{ load_asset_local('asset_header_after') }}
</head>

<body class="{{ page_body_class() }}">
    {{ load_asset_local('asset_body_before') }}
    {{ load_asset_local('asset_body_after') }}
    <div class="main-page">
        @include('theme::share.sidebar')
        <div class="page-container">
            @include('theme::share.header')
            <div class="content-main">
                @yield('content')
            </div>
            @include('theme::share.footer')
        </div>
    </div>
    @livewireScripts
    {{ load_asset_local('asset_footer_before') }}
    {{ load_asset_local('asset_footer_after') }}
    <div id='page-loader'>
        <div class="spinner"></div>
    </div>
</body>

</html>