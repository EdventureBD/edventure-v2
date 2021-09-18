<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $name;
    public $email;
    public $user_type;
    public $user_types;

    public function updatedName()
    {
        $this->validate([
            'name' => 'string|required|max:50',
        ]);
    }

    public function updatedEmail()
    {
        $this->validate([
            'email' => 'email:rfc,dns|unique:users|required',
        ]);
    }

    public function updatedUser_type()
    {
        $this->validate([
            'user_type' => 'required'
        ]);
    }

    protected $rules = [
        'name' => 'string|required|max:50',
        'email' => 'email:rfc,dns|unique:users|required',
        'user_type' => 'required'
    ];

    public function saveUser()
    {
        $data = $this->validate();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (($data['user_type']) == 1) {
            $user->is_admin = 1;
        } else {
            $user->is_admin = 0;
        }
        $user->user_type = $data['user_type'];
        $user->password = Hash::make(12345678);

        $save = $user->save();

        if ($save) {
            session()->flash('status', 'User successfully added!');
            return redirect()->route('user.index');
        } else {
            session()->flash('failed', 'User added failed!');
            return redirect()->route('user.create');
        }
    }

    public function mount()
    {
        $this->user_types = UserType::all();
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
