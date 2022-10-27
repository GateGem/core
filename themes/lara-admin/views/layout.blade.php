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
    <style>
        #page-loader {
            transition: all 0.3s ease-in-out;
            opacity: 1;
            visibility: visible;
            position: fixed;
            height: 100vh;
            width: 100%;
            background: #fff;
            z-index: 90000;
        }

        #page-loader.fadeOut {
            opacity: 0;
            visibility: hidden;
        }



        #page-loader .spinner {
            width: 40px;
            height: 40px;
            position: absolute;
            top: calc(50% - 20px);
            left: calc(50% - 20px);
            background-color: #333;
            border-radius: 100%;
            -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
            animation: sk-scaleout 1.0s infinite ease-in-out;
        }

        @-webkit-keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0)
            }

            100% {
                -webkit-transform: scale(1.0);
                opacity: 0;
            }
        }

        @keyframes sk-scaleout {
            0% {
                -webkit-transform: scale(0);
                transform: scale(0);
            }

            100% {
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="{{ page_body_class() }}">
    {{ load_asset_local('asset_body_before') }}
    {{ load_asset_local('asset_body_after') }}
    <div class="page-main">
        @include('theme::share.sidebar')
        <div class="page-container">
            @include('theme::share.header')
            <div class="page-content">
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
    <div class="modal"></div>
</body>

</html>
