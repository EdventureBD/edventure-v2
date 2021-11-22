<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Models\UserType;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $user;

    public $name;
    public $email;
    public $user_type;
    public $user_types;
    public $image;
    public $phone;
    public $tempImage;

    public function updatedName()
    {
        $this->validate([
            'name' => 'string|required|max:325',
        ]);
    }

    public function updatedEmail()
    {
        $this->validate([
            'email' => 'email:rfc,dns|required',
        ]);
    }

    public function updatedphone()
    {
        $this->validate([
            'phone' => 'required|numeric|digits:11',
        ]);
    }

    public function updatedImage()
    {
        $this->tempImage = $this->image;
    }

    public function updatedUser_type()
    {
        $this->validate([
            'user_type' => 'required'
        ]);
    }

    protected $rules = [
        'name' => 'string|required|max:325',
        'email' => 'email:rfc,dns|required',
        'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        'phone' => 'required|numeric|digits:11',
        'user_type' => 'required'
    ];

    public function saveUser()
    {
        $data = $this->validate();
        if ($this->tempImage) {
            $imageUrl = $this->image->store('public/user');
            $this->image = Storage::url( $imageUrl);
            Storage::delete($this->deleteImage);
        }
        $user = User::find($this->user->id);
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
        $this->phone = $this->user->phone;
        $this->image = $this->user->image;
        $this->deleteImage = $this->user->logo;

        $this->user_types = UserType::all();
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
