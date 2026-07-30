<?php

use App\Models\Contact;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Layout('layouts::app')] #[Title('Contact Us & Hospital Location | Advance Orthopaedic & Spine Center')] class extends Component
{
    #[Validate('required|min:3', message: 'Please enter your full name')]
    public string $name = '';

    #[Validate('required|email', message: 'Please enter a valid email address')]
    public string $email = '';

    #[Validate('required|min:8', message: 'Please enter a valid phone number')]
    public string $phone = '';

    public string $department = 'General Inquiry';

    public string $preferred_date = '';

    #[Validate('required|min:10', message: 'Please enter your message or symptoms (min 10 characters)')]
    public string $message = '';

    public bool $submitted = false;

    /**
     * Submit contact / appointment inquiry form and persist to database.
     */
    public function submitForm(): void
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'department' => $this->department ?: 'General Inquiry',
            'preferred_date' => $this->preferred_date ?: null,
            'message' => $this->message,
            'is_read' => false,
        ]);

        $this->submitted = true;

        $this->dispatch('toast-show', [
            'message' => 'Your inquiry has been submitted successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);

        $this->reset(['name', 'email', 'phone', 'department', 'preferred_date', 'message']);
    }

    /**
     * Dismiss success state notification.
     */
    public function dismissSuccess(): void
    {
        $this->submitted = false;
    }

    /**
     * Render view.
     */
    public function render()
    {
        return view('pages.contact.contact');
    }
};
