<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Dashboard | Contact Management System</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        @vite('resources/css/app.css')

    </head>
    <body>
        <div class="flex flex-col items-center gap-4 px-12 py-16">
            <h1>Admin Dashboard</h1>
            <p>This page is for testing (Authorization with <code>Gate</code>) purposes only.</p>
            <a href="/" class="btn btn-primary">Go Back Home</a>
        </div>
    </body>
</html>
