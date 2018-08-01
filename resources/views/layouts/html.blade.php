<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  @yield('meta', Bjuppa\MetaTagBag\MetaTagBag::make($metaTags ?? [])->merge(
    ['charset' => 'utf-8'],
    ['http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge'],
    ['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']
  ))

  <title>@yield('title', 'Blog')</title>

  @stack('styles')

  @stack('head')

</head>
<body>

@yield('body')

@stack('scripts')

</body>
