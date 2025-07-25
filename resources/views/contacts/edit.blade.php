<x-layout>
  <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="mx-auto max-w-screen-sm">
    @csrf
    @method('PATCH')

    <h2>Edit Contact</h2>

    {{-- FIRST NAME --}}
    <div class="form-group mt-4">
      <label for="first_name">First Name</label>
      <input 
        type="text" 
        id="first_name" 
        name="first_name"
        value="{{ $contact->first_name }}"
      >

      @error('first_name')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    {{-- LAST NAME --}}
    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input 
        type="text" 
        id="last_name" 
        name="last_name"
        value="{{ $contact?->last_name }}"
      >

      @error('last_name')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    {{-- PHONE --}}
    <div class="form-group">  
      <label for="phone">Phone Number</label>
      <input 
        type="text" 
        id="phone" 
        name="phone"
        value="{{ $contact->phone }}"
      >

      @error('phone')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    {{-- EMAIL --}}
    <div class="form-group">  
      <label for="email">Email</label>
      <input 
        type="email"
        id="email"
        name="email"
        value="{{ $contact?->email }}"
      >

      @error('email')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>

    {{-- ADDRESS --}}
    <div class="form-group">  
      <label for="address">Address</label>
      <input 
        type="address"
        id="address"
        name="address"
        value="{{ $contact?->address }}"
      >

      @error('address')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>
  
    {{-- DATE OF BIRTH --}}
    <div class="form-group"> 
      <label for="dob">Date of Birth</label>
      <input 
        type="date"
        id="dob"
        name="dob"
        value="{{ $contact?->dob }}"
      >

      @error('dob')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>
    
    {{-- NOTES --}}
    <div class="form-group"> 
      <label for="notes">Notes</label>
      <textarea
        rows="5"
        id="notes" 
        name="notes" 
      >{{ $contact?->notes }}</textarea>

      @error('notes')
        <span class="text-sm text-red-500">{{ $message }}</span>
      @enderror
    </div>


    <button type="submit" class="btn btn-primary">Update Contact</button>
  </form>
</x-layout>