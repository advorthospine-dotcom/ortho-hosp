<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    /**
     * Log the authenticated user out of the application.
     */
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
};
