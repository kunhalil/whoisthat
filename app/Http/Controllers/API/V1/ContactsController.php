<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\ContactNote;
use Illuminate\Support\Facades\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the contacts.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $filters = Request::only('name', 'company');

        $contacts = Contact::filter($filters)->get();

        return ContactResource::collection($contacts);
    }

    /**
     * Display a paginated listing of the contacts.
     *
     * @return \Illuminate\Http\Response
     */
    public function collection() : ContactCollection
    {
        $contacts = Contact::paginate();

        return new ContactCollection($contacts);
    }

    /**
     * Store a newly created contact in storage.
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $data = $request->all();

        $newContact = new Contact($data);
        $newContact->save();

        return new ContactResource($newContact);
    }

    /**
     * Display the specified contact.
     *
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $contact->load('notes');

        return new ContactResource($contact);
    }

    /**
     * Update the specified contact in storage.
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $data = $request->all();

        $contact->update($data);

        return new ContactResource($contact);
    }

    /**
     * Remove the specified contact from storage.
     *
     * @param  \App\Models\Contact $contact
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Contact $contact)
    // {
    //     $contact->delete();

    //     return ContactResource::collection($contacts);
    // }

    public function addNote(Contact $contact)
    {
        Request::validate([
            'note' => 'required|min:3|max:1000',
        ]);

        $note = new ContactNote(Request::only('note'));
        $contact->notes()->save($note);
        $contact->load('notes');

        return new ContactResource($contact);
    }
}
