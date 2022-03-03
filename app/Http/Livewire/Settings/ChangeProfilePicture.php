<?php

namespace App\Http\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class ChangeProfilePicture extends Component
{
    use WithFileUploads;

    public $image;
    public $user_image;

    public function updatedImage()
    {
        $this->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:4096']
        ]);
    }

    protected $rules = [
        'image' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:4096']
    ];

    public function updateUserImage()
    {
        $data = $this->validate();
        if ($this->image) {
            $imageUrl = $this->image->store('public/user');
            $this->user_image->image = $imageUrl;
        }
        $save = $this->user_image->save();

        if ($save) {
            session()->flash('status', 'Image uploaded successfully!');
            return redirect()->route('admin.settings');
        } else {
            session()->flash('failed', 'Image uploaded failed!');
            return redirect()->route('admin.settings');
        }
    }

    public function mount()
    {
        $this->user_image = Auth()->user();
    }

    public function render()
    {
        return view('livewire.settings.change-profile-picture');
    }
}
