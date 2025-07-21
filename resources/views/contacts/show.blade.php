<x-layout>
  <div class="shadow-xs border border-gray-300 rounded-xl">

    {{-- HEADER --}}
    <div class="border-b border-gray-300 py-3 px-4 flex justify-between items-center gap-2">

      {{-- BACK BUTTON --}}
      <a class="flex items-center gap-0.5" href="{{ route('contacts.index') }}">
        <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path d="M15.707 17.293l-5.293-5.293 5.293-5.293c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-6 6c-0.391 0.391-0.391 1.024 0 1.414l6 6c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414z"></path>
        </svg>
        <span>Back</span>
      </a>

      {{-- HEADING --}}
      <h2>Contact Details</h2>
      
      {{-- DELETE & EDIT --}}
      <div class="flex items-center gap-3">

        {{-- DELETE MODAL --}}
        <dialog data-modal class="m-auto bottom-25 py-3 px-4 rounded-lg space-y-5 backdrop:bg-black/50">
          <p class="flex flex-col items-center">
            <span>Are you sure you want to delete this contact?</span>
            <span class="text-red-500">This action cannot be undone.</span>
          </p>
          <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
            @csrf
            @method("DELETE")
            
            <div class="flex items-center gap-4 justify-end">
              <button class="btn" formmethod="dialog" type="submit">Cancel</button>
              <button class="btn btn-danger" type="submit">Confirm</button>
            </div>
          </form>
        </dialog>

        <button data-delete-btn class="cursor-pointer flex items-center justify-center">
          <svg class="w-5 h-5 fill-red-500 hover:fill-red-600" version="1.1" xmlns="http://www.w3.org/2000/svg" width="22" height="28" viewBox="0 0 22 28">
            <path d="M8 21.5v-11c0-0.281-0.219-0.5-0.5-0.5h-1c-0.281 0-0.5 0.219-0.5 0.5v11c0 0.281 0.219 0.5 0.5 0.5h1c0.281 0 0.5-0.219 0.5-0.5zM12 21.5v-11c0-0.281-0.219-0.5-0.5-0.5h-1c-0.281 0-0.5 0.219-0.5 0.5v11c0 0.281 0.219 0.5 0.5 0.5h1c0.281 0 0.5-0.219 0.5-0.5zM16 21.5v-11c0-0.281-0.219-0.5-0.5-0.5h-1c-0.281 0-0.5 0.219-0.5 0.5v11c0 0.281 0.219 0.5 0.5 0.5h1c0.281 0 0.5-0.219 0.5-0.5zM7.5 6h7l-0.75-1.828c-0.047-0.063-0.187-0.156-0.266-0.172h-4.953c-0.094 0.016-0.219 0.109-0.266 0.172zM22 6.5v1c0 0.281-0.219 0.5-0.5 0.5h-1.5v14.812c0 1.719-1.125 3.187-2.5 3.187h-13c-1.375 0-2.5-1.406-2.5-3.125v-14.875h-1.5c-0.281 0-0.5-0.219-0.5-0.5v-1c0-0.281 0.219-0.5 0.5-0.5h4.828l1.094-2.609c0.313-0.766 1.25-1.391 2.078-1.391h5c0.828 0 1.766 0.625 2.078 1.391l1.094 2.609h4.828c0.281 0 0.5 0.219 0.5 0.5z"></path>
          </svg>
        </button>

        {{-- EDIT --}}
        <a class="flex items-center justify-center" href="{{ route('contacts.edit', $contact->id) }}">
          <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="28" viewBox="0 0 24 28">
            <path d="M5.672 24l1.422-1.422-3.672-3.672-1.422 1.422v1.672h2v2h1.672zM13.844 9.5c0-0.203-0.141-0.344-0.344-0.344-0.094 0-0.187 0.031-0.266 0.109l-8.469 8.469c-0.078 0.078-0.109 0.172-0.109 0.266 0 0.203 0.141 0.344 0.344 0.344 0.094 0 0.187-0.031 0.266-0.109l8.469-8.469c0.078-0.078 0.109-0.172 0.109-0.266zM13 6.5l6.5 6.5-13 13h-6.5v-6.5zM23.672 8c0 0.531-0.219 1.047-0.578 1.406l-2.594 2.594-6.5-6.5 2.594-2.578c0.359-0.375 0.875-0.594 1.406-0.594s1.047 0.219 1.422 0.594l3.672 3.656c0.359 0.375 0.578 0.891 0.578 1.422z"></path>
          </svg>
        </a>
      </div>
    </div>
    
    {{-- MAIN CONTENT --}}
    <div class="py-3 px-4 space-y-4">
      <div class="flex items-center gap-2">
        <div class="bg-gray-200 h-14 w-14 rounded-full relative border border-gray-300 flex justify-center items-center">
          @php
            $name = $contact->first_name . ' ' . $contact->last_name;
            $parts = preg_split('/\s+/', trim($name));
            $initials = count($parts) === 1
                ? strtoupper(substr($parts[0], 0, 2))
                : strtoupper($parts[0][0] . $parts[count($parts) - 1][0]);
          @endphp
          <h1 class="absolute">{{ $initials }}</h1>
        </div>

        <div>
          <h3>{{$contact->first_name}} {{$contact?->last_name}}</h3>
          @if($contact?->email)
            <a class="text-sm" href="mailto:{{$contact?->email}}">{{$contact?->email}}</a>
          @endif
        </div>

        {{-- STARTED & UNSTARTED --}}
        <form action="{{ route('contacts.toggleStarted', $contact->id) }}" method="POST" class="ml-auto">
            @csrf
            @method("PATCH")

          <button class="cursor-pointer">
          @if($contact->started)
            <svg class="w-5 h-5 fill-cyan-500" version="1.1" xmlns="http://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28">
              <path d="M26 10.109c0 0.281-0.203 0.547-0.406 0.75l-5.672 5.531 1.344 7.812c0.016 0.109 0.016 0.203 0.016 0.313 0 0.406-0.187 0.781-0.641 0.781-0.219 0-0.438-0.078-0.625-0.187l-7.016-3.687-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641s0.625 0.344 0.766 0.641l3.516 7.109 7.844 1.141c0.375 0.063 0.875 0.25 0.875 0.719z"></path>
            </svg>
          @else
            <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28">
              <path d="M17.766 15.687l4.781-4.641-6.594-0.969-2.953-5.969-2.953 5.969-6.594 0.969 4.781 4.641-1.141 6.578 5.906-3.109 5.891 3.109zM26 10.109c0 0.281-0.203 0.547-0.406 0.75l-5.672 5.531 1.344 7.812c0.016 0.109 0.016 0.203 0.016 0.313 0 0.422-0.187 0.781-0.641 0.781-0.219 0-0.438-0.078-0.625-0.187l-7.016-3.687-7.016 3.687c-0.203 0.109-0.406 0.187-0.625 0.187-0.453 0-0.656-0.375-0.656-0.781 0-0.109 0.016-0.203 0.031-0.313l1.344-7.812-5.688-5.531c-0.187-0.203-0.391-0.469-0.391-0.75 0-0.469 0.484-0.656 0.875-0.719l7.844-1.141 3.516-7.109c0.141-0.297 0.406-0.641 0.766-0.641s0.625 0.344 0.766 0.641l3.516 7.109 7.844 1.141c0.375 0.063 0.875 0.25 0.875 0.719z"></path>
            </svg>
          @endif
          </button>
        </form>
      </div>

      <div class="flex items-center gap-2">
        <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="22" height="28" viewBox="0 0 22 28">
            <path d="M22 19.375c0 0.562-0.25 1.656-0.484 2.172-0.328 0.766-1.203 1.266-1.906 1.656-0.922 0.5-1.859 0.797-2.906 0.797-1.453 0-2.766-0.594-4.094-1.078-0.953-0.344-1.875-0.766-2.734-1.297-2.656-1.641-5.859-4.844-7.5-7.5-0.531-0.859-0.953-1.781-1.297-2.734-0.484-1.328-1.078-2.641-1.078-4.094 0-1.047 0.297-1.984 0.797-2.906 0.391-0.703 0.891-1.578 1.656-1.906 0.516-0.234 1.609-0.484 2.172-0.484 0.109 0 0.219 0 0.328 0.047 0.328 0.109 0.672 0.875 0.828 1.188 0.5 0.891 0.984 1.797 1.5 2.672 0.25 0.406 0.719 0.906 0.719 1.391 0 0.953-2.828 2.344-2.828 3.187 0 0.422 0.391 0.969 0.609 1.344 1.578 2.844 3.547 4.813 6.391 6.391 0.375 0.219 0.922 0.609 1.344 0.609 0.844 0 2.234-2.828 3.187-2.828 0.484 0 0.984 0.469 1.391 0.719 0.875 0.516 1.781 1 2.672 1.5 0.313 0.156 1.078 0.5 1.188 0.828 0.047 0.109 0.047 0.219 0.047 0.328z"></path>
        </svg> 
        <span>{{$contact->phone}}</span>
      </div>

      @if($contact?->address)
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28">
            <path d="M22 15.5v7.5c0 0.547-0.453 1-1 1h-6v-6h-4v6h-6c-0.547 0-1-0.453-1-1v-7.5c0-0.031 0.016-0.063 0.016-0.094l8.984-7.406 8.984 7.406c0.016 0.031 0.016 0.063 0.016 0.094zM25.484 14.422l-0.969 1.156c-0.078 0.094-0.203 0.156-0.328 0.172h-0.047c-0.125 0-0.234-0.031-0.328-0.109l-10.813-9.016-10.813 9.016c-0.109 0.078-0.234 0.125-0.375 0.109-0.125-0.016-0.25-0.078-0.328-0.172l-0.969-1.156c-0.172-0.203-0.141-0.531 0.063-0.703l11.234-9.359c0.656-0.547 1.719-0.547 2.375 0l3.813 3.187v-3.047c0-0.281 0.219-0.5 0.5-0.5h3c0.281 0 0.5 0.219 0.5 0.5v6.375l3.422 2.844c0.203 0.172 0.234 0.5 0.063 0.703z"></path>
          </svg>
          <span>{{$contact?->address}}</span>
        </div>
      @endif

      @if($contact?->dob)
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28">
            <path d="M2 26h22v-16h-22v16zM8 7v-4.5c0-0.281-0.219-0.5-0.5-0.5h-1c-0.281 0-0.5 0.219-0.5 0.5v4.5c0 0.281 0.219 0.5 0.5 0.5h1c0.281 0 0.5-0.219 0.5-0.5zM20 7v-4.5c0-0.281-0.219-0.5-0.5-0.5h-1c-0.281 0-0.5 0.219-0.5 0.5v4.5c0 0.281 0.219 0.5 0.5 0.5h1c0.281 0 0.5-0.219 0.5-0.5zM26 6v20c0 1.094-0.906 2-2 2h-22c-1.094 0-2-0.906-2-2v-20c0-1.094 0.906-2 2-2h2v-1.5c0-1.375 1.125-2.5 2.5-2.5h1c1.375 0 2.5 1.125 2.5 2.5v1.5h6v-1.5c0-1.375 1.125-2.5 2.5-2.5h1c1.375 0 2.5 1.125 2.5 2.5v1.5h2c1.094 0 2 0.906 2 2z"></path>
          </svg>
          <span>{{$contact?->dob}}</span>
        </div>
      @endif

      @if($contact?->notes)
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M3 12.984v-1.969h18v1.969h-18zM3 6h18v2.016h-18v-2.016zM3 18v-2.016h12v2.016h-12z"></path>
          </svg>
          <span>{{$contact?->notes}}</span>
        </div>
      @endif
    </div>
  </div>


  {{-- CONTROL DELETE MODAL --}}
  <script>
    const modal = document.querySelector("[data-modal]");
    const deleteBtn = document.querySelector("[data-delete-btn]");

    deleteBtn.addEventListener("click", () => {
        modal.showModal();
    });

    modal.addEventListener("click", event => {
      const dialogDimensions = modal.getBoundingClientRect()
      if (
        event.clientX < dialogDimensions.left ||
        event.clientX > dialogDimensions.right ||
        event.clientY < dialogDimensions.top ||
        event.clientY > dialogDimensions.bottom
      ) {
        modal.close()
      }
    })
  </script>
</x-layout>