<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $data = Contact::all();
        return view('contact');
    }
    public function add()
    {
        return view('contacts.contact');
    }
    public function create()
    {
        if (Auth::check()) {
            $validator = validator(request()->all(), [
                'name' => 'required',
                'email' => 'required',
                'message' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }
            $user_id = Auth::id();

            $contact = new Contact();
            $contact->user_id = $user_id;
            $contact->name = request()->name;
            $contact->email = request()->email;
            $contact->message = request()->message;
            $contact->save();

            session()->flash('success', 'Your message has been sent successfully!');
            return redirect()->route('home');
        }
        return redirect()->route('login');
    }

    public function delete($id)
    {
        $contact = Contact::find($id);
        $contact->delete()->with('info', 'Contact Deleted');
    }
}
