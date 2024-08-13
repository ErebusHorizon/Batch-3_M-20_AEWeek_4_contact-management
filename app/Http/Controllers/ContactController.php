<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // List all contacts with search and sort functionality
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at');
        $order = $sort === 'name' ? 'asc' : 'desc';

        $contacts = Contact::when($request->input('search'), function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })
            ->orderBy($sort, $order)
            ->paginate(5);

        $totalContacts = Contact::count();

        return view('contacts.index', compact('contacts', 'totalContacts'));
    }


    // Show the form to create a new contact
    public function create()
    {
        return view('contacts.create');
    }

    // Store a new contact in the database
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|unique:contacts,name',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'required|unique:contacts,phone',
            'address' => 'required|unique:contacts,address',
        ];

        // Define custom error messages
        $messages = [
            'name.unique' => 'এই নামটি ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'email.unique' => 'এই ইমেইলটি ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'phone.unique' => 'এই ফোন নম্বরটি ইতিমধ্যে ব্যবহৃত হয়েছে।',
            'address.unique' => 'এই ঠিকানা ইতিমধ্যে ব্যবহৃত হয়েছে।',
        ];

        // Validate the request
        $request->validate($rules, $messages);

        // Create new contact
        Contact::create($request->all());

        // Redirect with success message
        return redirect()->route('contacts.index')->with('success', 'নতুন কন্ট্রাক্ট সফলভাবে তৈরি হয়েছে।');
    }

    // Show a specific contact
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view('contacts.show', compact('contact'));
    }

    // Show the form to edit an existing contact
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    // Update an existing contact in the database
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:contacts,name,' . $contact->id,
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'phone' => 'nullable|unique:contacts,phone,' . $contact->id,
            'address' => 'nullable|unique:contacts,address,' . $contact->id,
        ], [
            'name.unique' => 'The name already exists.',
            'email.unique' => 'The email address already exists.',
            'phone.unique' => 'The phone number already exists.',
            'address.unique' => 'The address already exists.',
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    // Delete a contact from the database
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }
}
