const mix = require('laravel-mix');

mix.setPublicPath('public_html/');
mix.ts('resources/js/app.ts', 'public_html/js').vue({version: 3})
    .postCss('resources/css/app.css', 'public_html/css', [
        require('tailwindcss')
    ])
    .sourceMaps();
