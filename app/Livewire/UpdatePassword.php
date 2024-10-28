<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdatePassword extends Component
{
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    public function render()
    {
        return view('livewire.update-password')->title('Update password');
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'Please enter your current password.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'The new password must be at least 6 characters long.',
            'new_password.confirmed' => 'New password and confirmation do not match.',
        ];
    }

    public function updatePassword()
    {
        $this->validate();

        // Verify if current password matches
        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        // Update the user's password
        Auth::user()->update([
            'password' => Hash::make($this->new_password),
        ]);

        // Optional: Add success message or redirect
        session()->flash('success', 'Your password has been updated successfully.');
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }
}
