<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @yield('meta', Bjuppa\MetaTagBag\MetaTagBag::make(config('blog.default_meta_tags'))->merge($metaTags ?? [])->merge(['charset' => 'utf-8']))

  <title>@yield('title', 'Blog')</title>

  @stack('styles')

  @stack('head')

</head>
<body>

@yield('body')

@stack('scripts')

</body>
