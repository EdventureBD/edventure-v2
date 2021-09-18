<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserType;

class Edit extends Component
{
    public $user;

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
            'email' => 'email:rfc,dns|required',
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
        'email' => 'email:rfc,dns|required',
        'user_type' => 'required'
    ];

    public function saveUser()
    {
        $data = $this->validate();
        $user = User::find($this->user->id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (($data['user_type']) == 1) {
            $user->is_admin = 1;
        } else {
            $user->is_admin = 0;
        }
        $user->user_type = $data['user_type'];

        $save = $user->save();

        if ($save) {
            session()->flash('status', 'user successfully updated!');
            return redirect()->route('user.index');
        } else {
            session()->flash('failed', 'User updated failed!');
            return redirect()->route('user.edit', $this->user->id);
        }
    }

    public function mount()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->user_type = $this->user->user_type;

        $this->user_types = UserType::all();
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
