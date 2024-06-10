<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Hugo 0.74.3" />

    @include('layouts.partials.link')
</head>

<body>

    @include('layouts.partials.nav')
    
    <section class="section pb-0">
        <div class="container">
            @yield('content')
        </div>
    </section>



    @include('layouts.partials.footer')


    @include('layouts.partials.script')


</body>

</html>
