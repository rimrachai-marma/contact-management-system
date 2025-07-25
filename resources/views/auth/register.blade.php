<x-layout>
  <form action="{{ route('register') }}" method="POST" class="mx-auto max-w-screen-sm">
    @csrf

    <h2>Register for an Account</h2>

    <div class="form-group">
      <label for="name">Name</label>
      <input
        id="name"
        type="text"
        name="name"
        value="{{ old('name') }}"
      >
      @error('name')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>


    <div class="form-group">
      <label for="email">Email</label>
      <input
        id="email"
        type="email"
        name="email"
        value="{{ old('email') }}"
      >
      @error('email')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input
        id="password"
        type="password"
        name="password"
        
      >
      @error('password')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>


    <div class="form-group">
      <label for="password_confirmation">Confirm Password</label>
      <input 
        id="password_confirmation"
        type="password"
        name="password_confirmation"
      >

      @error('password_confirmation')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>
    

    <button type="submit" class="btn btn-primary">Register</button>    
  </form>
</x-layout>