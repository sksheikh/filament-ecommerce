<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

class ProfilePage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $date_of_birth;
    public $gender;

    public $is_editing = false;

    public $is_changing_password = false;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public $is_changing_email = false;
    public $current_email;
    public $new_email;
    public $email_password;

    public function mount()
    {
        $customer = auth()->guard('customer')->user();
        $this->first_name = $customer->first_name;
        $this->last_name = $customer->last_name;
        $this->phone = $customer->phone;
        $this->date_of_birth = $customer->date_of_birth;
        $this->gender = $customer->gender;
        $this->current_email = $customer->email;
    }

    public function toggleEdit()
    {
        $this->is_editing = !$this->is_editing;
    }

    public function updateProfile()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
        ]);

        $customer = auth()->guard('customer')->user();
        $customer->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->first_name . ' ' . $this->last_name,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
        ]);

        $this->is_editing = false;
        
        $this->dispatch('toast', [
            'icon' => 'success',
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function toggleChangePassword()
    {
        $this->is_changing_password = !$this->is_changing_password;
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->resetValidation();
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        $customer = auth()->guard('customer')->user();

        if (!Hash::check($this->current_password, $customer->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        $customer->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->is_changing_password = false;
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        $this->dispatch('toast', [
            'icon' => 'success',
            'message' => 'Password changed successfully!'
        ]);
    }

    public function toggleChangeEmail()
    {
        $this->is_changing_email = !$this->is_changing_email;
        $this->reset(['new_email', 'email_password']);
        $this->resetValidation();
    }

    public function changeEmail()
    {
        $this->validate([
            'new_email' => 'required|email|unique:customers,email,' . auth()->guard('customer')->id(),
            'email_password' => 'required|string',
        ], [
            'new_email.unique' => 'This email is already in use.',
        ]);

        $customer = auth()->guard('customer')->user();

        if (!Hash::check($this->email_password, $customer->password)) {
            $this->addError('email_password', 'The password is incorrect.');
            return;
        }

        $customer->update([
            'email' => $this->new_email,
        ]);

        $this->current_email = $this->new_email;
        $this->is_changing_email = false;
        $this->reset(['new_email', 'email_password']);

        $this->dispatch('toast', [
            'icon' => 'success',
            'message' => 'Email changed successfully!'
        ]);
    }

    public function render()
    {
        return view('livewire.profile-page')
        ->title("My Profile | " . config('app.name'));
    }
}
