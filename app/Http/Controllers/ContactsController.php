<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    private $_recs_per_page;

    public function __construct()
    {
        $this->_recs_per_page = config('constants.RECS_PER_PAGE');
        $this->middleware('auth')->except(['index', 'show', 'archived']); 
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate($this->_recs_per_page);
        return view('contacts.index',compact('contacts'))->with('i', (request()->input('page', 1) - 1) * $this->_recs_per_page);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required|unique:contacts|digits:9'
        ]);
 
        if ($validator->fails()) {
            return redirect('contacts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        Contact::create($validator->validated());
   
        return redirect()->route('contacts.index')->with('success','Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'phone' => 'required||digits:9|unique:contacts,phone,' . $contact->id,
        ]);
 
        if ($validator->fails()) {
            return redirect('contacts/' . $contact->id . '/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $contact->update($validator->validated());
   
        return redirect()->route('contacts.index')->with('success','Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success','Contact deleted successfully');
    }

    /**
     * Display a listing of removed records of the resource.
     */
    public function archived()
    {
        $contacts = Contact::onlyTrashed()->paginate($this->_recs_per_page);
        return view('contacts.archived',compact('contacts'))->with('i', (request()->input('page', 1) - 1) * $this->_recs_per_page);
    }

    /**
     * Display a listing of removed records of the resource.
     */
    public function restore($contactId)
    {
        Contact::withTrashed()->find($contactId)->restore();
        return redirect()->route('contacts.index')->with('success','Contact restored successfully');
    }
}
