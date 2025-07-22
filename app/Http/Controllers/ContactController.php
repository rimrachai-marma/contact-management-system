<?php

namespace App\Http\Controllers;

use App\Models\Contact;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;


class ContactController extends Controller{
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

        return view('contacts.index', [
            'contacts' => $contacts,
            'search' => $request->input('search'),
            'started' => $request->input('started'),
            'sort' => $request->input('sort',),
            'order' => $request->input('order'),
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


    // route::get -> /contacts/{id}

    // public function show ($id){
    //     $contact = Contact::findOrFail($id);
    //     return view('contacts.show', ["contact" => $contact]);
    // }
    public function show (Contact $contact){
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        return view('contacts.show', ["contact" => $contact]);
    }


    // route::get -> /contacts/{id}/edit

    // public function edit ($id) {
    //     $contact = Contact::findOrFail($id);
    //     return view('contacts.edit',["contact" => $contact]);
    // }
    public function edit (Contact $contact) {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        return view('contacts.edit',["contact" => $contact]);
    }


    // route::patch -> /contacts/{id}

    // public function update (UpdateContactRequest $request, $id) {
    //     $contact = Contact::findOrFail($id);
    //     $contact->update($request->validated());
        
    //     return redirect()->route('contacts.show', $contact)->with('success', 'Contact Updated!');
    // }
    public function update (UpdateContactRequest $request, Contact $contact) {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        $contact->update($request->validated());

        return redirect()->route('contacts.show', $contact)->with('success', 'Contact Updated!');
    }


    // route::delete -> /contacts/{id}

    // public function destroy ($id){
    //     $contact = Contact::findOrFail($id);
    //     $contact->delete();
        
    //     return redirect()->route('contacts.index')->with('success', 'Contact Deleted!');
    // }
    public function destroy (Contact $contact){
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        $contact->delete();
        
        return redirect()->route('contacts.index')->with('success', 'Contact Deleted!');
    }


    // route::patch -> /contacts/{contact}/toggle-started
    
    // public function toggleStarte ($id) {
    //     $contact = Contact::findOrFail($id);

    //     if ($contact->user_id !== Auth::id()) {
    //         abort(403);
    //     }

    //     $contact->started = !$contact->started;
    //     $contact->save();

    //     $message = $contact->started ? 'Contact starred!' : 'Contact unstarred!';

    //     return redirect()->back()->with('success', $message);
    // }
    public function toggleStarted(Contact $contact) {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        $contact->started = !$contact->started;
        $contact->save();

        $message = $contact->started ? 'Contact starred!' : 'Contact unstarred!';

        return redirect()->back()->with('success', $message);
    }
}



