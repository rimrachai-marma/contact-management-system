<x-layout>
  <form action="{{ route('contacts.store') }}" method="POST" class="mx-auto">
    @csrf

    <h2>Create New Contact</h2>

    <div class="form-group mt-4">
      <label for="first_name">First Name</label>
      <input 
        type="text" 
        id="first_name" 
        name="first_name"
        value="{{ old('first_name') }}"
      >

      @error('first_name')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input 
        type="text" 
        id="last_name" 
        name="last_name"
        value="{{ old('last_name') }}"
      >

      @error('last_name')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">  
      <label for="phone">Phone Number</label>
      <input 
        type="text" 
        id="phone" 
        name="phone"
        value="{{ old('phone') }}"
      >

      @error('phone')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">  
      <label for="email">Email</label>
      <input 
        type="email"
        id="email"
        name="email"
        value="{{ old('email') }}"
      >

      @error('email')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group">  
      <label for="address">Address</label>
      <input 
        type="address"
        id="address"
        name="address"
        value="{{ old('address') }}"
      >

      @error('address')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div class="form-group"> 
      <label for="dob">Date of Birth</label>
      <input 
        type="date"
        id="dob"
        name="dob"
        value="{{ old('dob') }}"
      >

      @error('dob')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>
    
    <div class="form-group"> 
      <label for="notes">Notes</label>
      <textarea
        rows="5"
        id="notes" 
        name="notes" 
      >{{ old('notes') }}</textarea>

      @error('notes')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>


    <button type="submit" class="btn btn-primary">Create Contact</button>
    
  </form>
</x-layout>