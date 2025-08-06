<?php

namespace App\Http\Controllers;

use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContactController extends Controller {
    // Use AuthorizesRequests trait to handle authorization
    use AuthorizesRequests;

    // route::get -> /contacts
    public function index(Request $request) {
        $query = Contact::where('user_id', Auth::id());

        // Search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $query->where(function ($_query) use ($search) {
                $_query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Started filter
        if ($request->has('started') && in_array($request->started, ['0', '1'])) {
            $query->where('started', $request->started);
        }

        // Sorting
        $sortKey = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');
 
        $sort = ['name' => 'first_name', 'created_at' => 'created_at'][$sortKey] ?? 'first_name';
        $order = in_array(strtolower($order), ['asc', 'desc']) ? strtolower($order) : 'asc';

        $query->orderBy($sort, $order);

        $contacts = $query->paginate(12)->appends($request->only(['search', 'started', 'sort', 'order']));
        $totalContacts = Contact::where('user_id', Auth::id())->count();

        return view('contacts.index', [
            'contacts' => $contacts,
            'search' => $request->input('search'),
            'started' => $request->input('started'),
            'sort' => $request->input('sort',),
            'order' => $request->input('order'),
            'totalContacts' => $totalContacts,
        ]);
        
    }

    // route::get -> /contacts/create
    public function create() {
        return view('contacts.create');
    }

    // route::post -> /contacts
    public function store(StoreContactRequest $request) {
        $request->merge(['user_id' => Auth::id()]);

        Contact::create($request->all()); 

        return redirect()->route('contacts.index')->with('success', 'Contact Created!');
    }

    // route::get -> /contacts/{contact}
    public function show (Contact $contact){
        $this->authorize('view', $contact);

        return view('contacts.show', ["contact" => $contact]);
    }


    // route::get -> /contacts/{contact}/edit
    public function edit (Contact $contact) {
        $this->authorize('update', $contact);

        return view('contacts.edit',["contact" => $contact]);
    }


    // route::patch -> /contacts/{contact}
    public function update (UpdateContactRequest $request, Contact $contact) {
        $this->authorize('update', $contact);

        $contact->update($request->validated());

        return redirect()->route('contacts.show', $contact)->with('success', 'Contact Updated!');
    }


    // route::delete -> /contacts/{contact}
    public function destroy (Contact $contact){
        $this->authorize('delete', $contact);

        $contact->delete();
        
        return redirect()->route('contacts.index')->with('success', 'Contact Deleted!');
    }


    // route::patch -> /contacts/{contact}/toggle-started
    public function toggleStarted(Contact $contact) {
        $this->authorize('update', $contact);

        $contact->started = !$contact->started;
        $contact->save();

        $message = $contact->started ? 'Contact starred!' : 'Contact unstarred!';

        return redirect()->back()->with('success', $message);
    }
}



