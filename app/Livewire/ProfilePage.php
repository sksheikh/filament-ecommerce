<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('My Profile - Nafisa Mart')]
class ProfilePage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $date_of_birth;
    public $gender;

    public $is_editing = false;

    public function mount()
    {
        $customer = auth()->guard('customer')->user();
        $this->first_name = $customer->first_name;
        $this->last_name = $customer->last_name;
        $this->phone = $customer->phone;
        $this->date_of_birth = $customer->date_of_birth;
        $this->gender = $customer->gender;
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

    public function render()
    {
        return view('livewire.profile-page');
    }
}
