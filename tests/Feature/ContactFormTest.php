<?php

namespace Tests\Feature;

use App\Http\Livewire\ContactForm;
use App\Mail\ContactFormMailable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_if_has_livewire_component(): void
    {
        $response = $this->get('/');
        $response->
            assertSeeLivewire('contact-form');
    }

    public function test_contact_sending_email()
    {
        Mail::fake();
        Mail::assertNothingSent();

        Livewire::test(ContactForm::class)
            ->set('name', 'Andrwe')
            ->set('email', 'ratik@yahoo.com')
            ->set('message', 'this is my message')
            ->call('submitForm')
            ->assertSee('Message received');

        Mail::assertSent(ContactFormMailable::class, 1);

        Mail::assertSent(ContactFormMailable::class, function ($mail) {
            return $mail->hasTo('admin@adrian.com');
        });
    }

    public function test_form_validation() {
        Livewire::test(ContactForm::class)
            ->set('email', 'jakldj@yahoo.com')
            ->set('name', 'ratik') 
            ->call('submitForm')
            ->assertHasErrors(['message' => 'required']);
    }
}
