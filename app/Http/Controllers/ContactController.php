<?php

namespace App\Http\Controllers;


use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Repositories\ContactInterface;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    protected $contact;

    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

    public function contact(ContactRequest $request)
    {
        if($contact = $this->contact->save($request->only('name','email','website','message'))){
            $contactMail = settings('contact_email');
            Mail::to($contactMail)->send(new ContactMail($contact));
            return redirect()->back()->with('success', __('Your message has been sent successfully to the administrator.'));
        }

        return redirect()->back()->with('error', __('Failed to send your message.'));
    }
}
