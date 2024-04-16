<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite('resources/css/app.css')
    </head>
    <body class="antialiased relative bg-gray-800 text-gray-100 py-2 md:py-4 px-2 md:px-4 flex justify-center items-center h-screen">
        <header class="absolute top-4 right-2">
        <a href="" class="text-sm font-semibold bg-gray-600 rounded-md p-2 "><img src="assets/icon-github.png" alt="" width="22px" class="inline-block mr-1"> maviism</a>
        </header>
        <main>
            <div>
                <h1 class="text-4xl font-bold text-center">Document Downloader</h1>
                <p class="text-center">Download your ppt, document, pdf from any website like scribd, slideshare</p>
            </div>
            <livewire:downloader />
        </main>

        @stack('scripts')
    </body>
</html>
