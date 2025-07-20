<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Management System</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body>

    <!-- HEADER  -->
    <header>
      <nav>
        <h1><a href="{{ route('contacts.index') }}">Contacts</a></h1>
        
        @guest
          <a href="{{ route('show.login') }}" class="btn btn-primary">Login</a>
          <a href="{{ route('show.register') }}" class="btn btn-primary">Register</a>
        @endguest
        
        @auth
          <span class="border-r-2 pr-5 border-gray-300">
            Hi there, {{ Auth::user()->name }}
          </span>

          <a href="{{ route('contacts.create') }}">Create New Contact</a>
          
          <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-primary">Logout</button>
          </form>
        @endauth
        
      </nav>
    </header>

    <!-- FLASH MESSAGE  -->
    @if (session('success'))
      <div id="flash" class="p-4 text-center bg-green-50 text-green-500 font-bold">
        {{ session('success') }}
      </div>
    @endif

    <!-- MAIN CONTAINT -->
    <main class="container">
      {{ $slot }}
    </main>
</body>
</html>