<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

#[Title('Reset Password | Nafisa Mart')]
class ResetPasswordPage extends Component
{
    public $token;
    #[Url]
    public $email;
    public $password;
    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request()->query('email') ?? $this->email;
    }

    public function save()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Here you would typically handle the password reset logic,
        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();

                event(new PasswordReset($user));
            }
        );
        if ($status === Password::PASSWORD_RESET) {
            // success
            return redirect('/login');
        }

        // failed - show error to user
        session()->flash('error', 'Something went wrong. Please try again.');
    }

    public function render()
    {
        return view('livewire.auth.reset-password-page');
    }
}
