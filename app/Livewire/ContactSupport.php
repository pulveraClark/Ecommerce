<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactSupport extends Component
{
    public $name;
    public $email;
    public $message;
    public $success_message;

    public function sendMessage()
    {
        // Validate input
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Prepare email content
        $content = "Name: {$this->name}\nEmail: {$this->email}\n\nMessage:\n{$this->message}";

        // Send email via Mailtrap SMTP
        Mail::raw($content, function ($mail) {
            $mail->to(env('MAIL_FROM_ADDRESS')) // Use your MAIL_FROM_ADDRESS from .env
                 ->subject('New Support Message');
        });

        // Set success message and reset fields
        $this->success_message = 'Message sent successfully!';
        $this->reset(['name', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-support');
    }
}
