<?php

namespace App\Http\Livewire\Settings;

use App\Models\User;
use Livewire\Component;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class Changepassword extends Component
{
    public $Password;
    public $newPassword;
    public $confirmNewPassword;

    public function updatedPassword()
    {
        $this->validate([
            'Password' => ['required', new MatchOldPassword, 'min:5'],
        ]);
    }

    public function updatedNewPassword()
    {
        $this->validate([
            'newPassword' => 'required|min:5',
        ]);
    }

    public function updatedConfirmNewPassword()
    {
        $this->validate([
            'confirmNewPassword' => 'required|same:newPassword|min:5',
        ]);
    }

    public function updatePassword()
    {
        $data = $this->validate([
            'Password' => ['required', new MatchOldPassword, 'min:5'],
            'newPassword' => ['required', 'min:5'],
            'confirmNewPassword' => ['required', 'same:newPassword', 'min:5'],
        ]);
        $changed_password = User::find(auth()->user()->id)->update(['password' => Hash::make($data['newPassword'])]);

        if ($changed_password) {
            session()->flash('status', 'Password Changed Successfully!');
            return redirect()->route('admin.settings');
        } else {
            session()->flash('failed', 'Password Changed failed!');
            return redirect()->route('admin.settings');
        }
    }

    public function render()
    {
        return view('livewire.settings.changepassword');
    }
}
