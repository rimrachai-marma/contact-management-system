<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;


class ContactController extends Controller{
    // route::get -> /contacts
    public function index() {       
        $contacts = Contact::where("user_id", Auth::id())->orderBy('first_name', 'asc')->paginate(12);
        return view('contacts.index', ["contacts" => $contacts]);
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



