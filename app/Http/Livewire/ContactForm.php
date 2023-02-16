<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public $name;
    public $message;
    public $email;
    public $successMessage;

    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'message' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }

    public function submitForm()
    {
        $contact = $this->validate();
        $contact['message'] = $this->message;
        $contact['emai'] = $this->email;
        Mail::to('admin@adrian.com')->send(new ContactFormMailable($contact));
        $this->successMessage = 'Message received';

        $this->resetForm();
        // session()->flash('success_message', 'Message received');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->message = '';
        $this->email = '';
    }
}
