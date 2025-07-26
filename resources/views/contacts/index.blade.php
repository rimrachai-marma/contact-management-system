<x-layout>
    <div class="flex items-center gap-8 mb-6 w-full">
        <form method="GET" action="{{ route('contacts.index', ['started' => request('started')]) }}" class="w-full" data-search-form>
            <div class="flex items-center h-10 border rounded">
                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search with name or email"
                    class="pl-3 outline-0 w-full h-full bg-transparent"
                    data-search-input
                />
                <button class="flex justify-center items-center h-full w-10 cursor-pointer">
                    <svg class="w-5 h-5 fill-current" version="1.1" xmlns="http://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28">
                        <path d="M18 13c0-3.859-3.141-7-7-7s-7 3.141-7 7 3.141 7 7 7 7-3.141 7-7zM26 26c0 1.094-0.906 2-2 2-0.531 0-1.047-0.219-1.406-0.594l-5.359-5.344c-1.828 1.266-4.016 1.937-6.234 1.937-6.078 0-11-4.922-11-11s4.922-11 11-11 11 4.922 11 11c0 2.219-0.672 4.406-1.937 6.234l5.359 5.359c0.359 0.359 0.578 0.875 0.578 1.406z"></path>
                    </svg>
                </button>
            </div>

            <!-- Preserve filter and sort -->
            @if(request('started') !== null)
                <input type="hidden" name="started" value="{{ request('started') }}">
            @endif

            @if(request('sort') !== null)
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            @if(request('order') !== null)
                <input type="hidden" name="order" value="{{ request('order') }}">
            @endif
        </form>
        <script>
            function debounce(func, delay) {
                let timer;
                return function (...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            }

            const form = document.querySelector("[data-search-form]");
            const input = document.querySelector("[data-search-input]");

            input.addEventListener('input', debounce(function () {
                if (this.value.trim() === "") {
                    this.removeAttribute('name');
                }

                form.submit();
            }, 500));
        </script>

        <form method="GET" action="{{ route('contacts.index') }}" data-status-form>
            <select name="started" data-status-select class="px-3 h-10 border rounded cursor-pointer bg-transparent">
                <option value="">-- Select Status --</option>
                <option value="1" {{ request('started') === '1' ? 'selected' : '' }}>Started</option>
                <option value="0" {{ request('started') === '0' ? 'selected' : '' }}>Not Started</option>
            </select>

            <!-- Preserve search and sort -->
            @if(request('search') !== null)
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            @if(request('sort') !== null)
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            @if(request('order') !== null)
                <input type="hidden" name="order" value="{{ request('order') }}">
            @endif
        </form>

        <script>
            document.querySelector("[data-status-select]").addEventListener('change', function () {
                const form = document.querySelector("[data-status-form]");
                if (this.value === "") {
                    this.removeAttribute('name');
                }

                form.submit();
            });
        </script>

        <div class="flex items-center justify-between gap-2 h-10 border rounded">
            <form method="GET" action="{{ route('contacts.index') }}" class="w-full" data-sort-form>
                <select name="sort" data-sort-select class="pl-3 h-full outline-0 cursor-pointer bg-transparent">
                    <option value="">-- Sort By</option>
                    <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name</option>
                    <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Created At</option>
                </select>

                <!-- Preserve search filter and order -->
                @if(request('search') !== null)
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                @if(request('started') !== null)
                    <input type="hidden" name="started" value="{{ request('started') }}">
                @endif

                @if(request('order') !== null)
                    <input type="hidden" name="order" value="{{ request('order') }}">
                @endif
            </form>
            <script>
                document.querySelector("[data-sort-select]").addEventListener('change', function () {
                    const form = document.querySelector("[data-sort-form]");
                    if (this.value === "") {
                        this.removeAttribute('name');
                    }

                    form.submit();
                });
            </script>

            <form method="GET" action="{{ route('contacts.index') }}" class="w-full" data-order-form>
                <select name="order" data-order-select class="pr-3 h-full outline-0 bg-transparent cursor-pointer">
                    <option value="">Order By --</option>
                    <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>ASC</option>
                    <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>DESC</option>
                </select>

                <!-- Preserve search, filter and sort -->
                @if(request('search') !== null)
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif

                @if(request('started') !== null)
                    <input type="hidden" name="started" value="{{ request('started') }}">
                @endif

                @if(request('sort') !== null)
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif
            </form>
            <script>
                document.querySelector("[data-order-select]").addEventListener('change', function () {
                    const form = document.querySelector("[data-order-form]");
                    if (this.value === "") {
                        this.removeAttribute('name');
                    }

                    form.submit();
                });
            </script>
        </div>
    </div>

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

    @elseif ($totalContacts > 0)
        <div class="flex flex-col items-center gap-4 px-8 py-16">
            <p class="text-lg">No contacts found!</p>
            <a href="{{ route('contacts.index') }}" class="btn btn-primary">View All Contacts ({{ $totalContacts }})</a>
        </div>
    @else
        <div class="flex flex-col items-center gap-4 px-8 py-16">
            <p class="text-lg">You have no saved contact!</p>
            <a href="{{ route('contacts.create') }}" class="btn btn-primary">Create New Contact</a>
        </div>
    @endif
</x-layout>