<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserType;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $user_type;
    public $user_types;
    public $image;
    public $phone;

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

    public function updatedphone()
    {
        $this->validate([
            'phone' => 'required|numeric|digits:11',
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
        'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        'email' => 'email:rfc,dns|unique:users|required',
        'phone' => 'required|numeric|digits:11',
        'user_type' => 'required'
    ];

    public function saveUser()
    {
        $data = $this->validate();
        if ($this->image) {
            $imageUrl = $this->image->store('public/user');
            $this->image = $imageUrl;
        }
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->image = $this->image;
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
