<x-layout>
    <h2>All Contacts</h2>
    @if ($contacts->count() > 0)
        <ul>
            @foreach($contacts as $contact)
                <li>
                    <x-card href="{{ route('contacts.show', $contact->id) }}" :started="$contact->started">
                        <div class="space-y-2">
                            <h3 class="flex items-center gap-1">
                                <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="28" viewBox="0 0 20 28">
                                    <path d="M20 21.859c0 2.281-1.5 4.141-3.328 4.141h-13.344c-1.828 0-3.328-1.859-3.328-4.141 0-4.109 1.016-8.859 5.109-8.859 1.266 1.234 2.984 2 4.891 2s3.625-0.766 4.891-2c4.094 0 5.109 4.75 5.109 8.859zM16 8c0 3.313-2.688 6-6 6s-6-2.688-6-6 2.688-6 6-6 6 2.688 6 6z"></path>
                                </svg>
                                <span>{{$contact->first_name}} {{$contact?->last_name}}</span>               
                            </h3>
                            <p class="flex items-center gap-1">
                                <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="22" height="28" viewBox="0 0 22 28">
                                    <path d="M22 19.375c0 0.562-0.25 1.656-0.484 2.172-0.328 0.766-1.203 1.266-1.906 1.656-0.922 0.5-1.859 0.797-2.906 0.797-1.453 0-2.766-0.594-4.094-1.078-0.953-0.344-1.875-0.766-2.734-1.297-2.656-1.641-5.859-4.844-7.5-7.5-0.531-0.859-0.953-1.781-1.297-2.734-0.484-1.328-1.078-2.641-1.078-4.094 0-1.047 0.297-1.984 0.797-2.906 0.391-0.703 0.891-1.578 1.656-1.906 0.516-0.234 1.609-0.484 2.172-0.484 0.109 0 0.219 0 0.328 0.047 0.328 0.109 0.672 0.875 0.828 1.188 0.5 0.891 0.984 1.797 1.5 2.672 0.25 0.406 0.719 0.906 0.719 1.391 0 0.953-2.828 2.344-2.828 3.187 0 0.422 0.391 0.969 0.609 1.344 1.578 2.844 3.547 4.813 6.391 6.391 0.375 0.219 0.922 0.609 1.344 0.609 0.844 0 2.234-2.828 3.187-2.828 0.484 0 0.984 0.469 1.391 0.719 0.875 0.516 1.781 1 2.672 1.5 0.313 0.156 1.078 0.5 1.188 0.828 0.047 0.109 0.047 0.219 0.047 0.328z"></path>
                                </svg> 
                                <a href="tel:{{$contact->phone}}" class="text-cyan-500">
                                    {{$contact->phone}}
                                </a>
                            </p>
                        </div>
                    </x-card>
                </li>
            @endforeach
        </ul>

    {{ $contacts->onEachSide(1)->links() }}
    @else
        <div class="flex flex-col items-center gap-4 px-8 py-16">
            <p class="text-lg">You have no saved contact!</p>
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">Create New Contact</a>
        </div>
    @endif
</x-layout>