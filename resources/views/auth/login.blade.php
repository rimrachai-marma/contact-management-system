<x-layout>
  <form action="{{ route('login') }}" method="POST" class="mx-auto max-w-screen-sm">
    @csrf

    <h2>Log In to Your Account</h2>

    <div class="form-group">
      <label for="email">Email</label>
      <input 
        id="email"
        type="email"
        name="email"
        value="{{ old('email') ? old('email') : 'rimrachai@email.com' }}"
      >
      @error('email')
        <div class="text-sm text-red-500">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input 
        id="password"
        type="password"
        name="password"
        value="12345678"
      >
      @error('password')
        <div class="text-sm text-red-500">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-primary">Log in</button>

    @error('credentials')
      <div class="mt-4 px-4 py-2 bg-red-100 text-sm text-red-500">{{ $message }}</div>
    @enderror
    
  </form>
</x-layout>