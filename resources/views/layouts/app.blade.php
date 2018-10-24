<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Engineering Helpline') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Google adsense --}}
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-4795174475971646",
            enable_page_level_ads: true
        });
    </script>
</head>
<body>
    <div id="app">
        <!-- show navbar layout for logged users only -->
        @if(Auth::guest())
            @include('inc.starterNav')
        @else
            @include('inc.navbar')
        @endif
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
        <br><br><br><br><br>
        @include('inc.footer')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        //CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>
