<?php

namespace App\Http\Livewire\User;

use App\Models\TeacherDetail;
use App\Models\User;
use Livewire\Component;
use App\Models\UserType;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $user_type;
    public $user_types;
    public $image;
    public $phone;
    public $education;
    public $year_of_experience;
    public $expertise;

    public function updatedName()
    {
        $this->validate([
            'name' => 'string|required|max:325',
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
            'phone' => 'required||unique:users|numeric|digits:11',
        ]);
    }

    public function updatedUser_type()
    {
        $this->validate([
            'user_type' => 'required'
        ]);
    }

//    protected $rules = ;

    protected $customMessages = [
        'required' => 'The :attribute field is required.'
    ];

    public function saveUser()
    {
        $data = $this->validate([
            'name' => 'string|required|max:325',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
            'email' => 'email:rfc,dns|unique:users|required',
            'phone' => 'required|numeric|digits:11',
            'user_type' => 'required',
            'education' => ['required_if:user_type,2'],
            'year_of_experience' => ['required_if:user_type,2','number'],
            'expertise' => ['required_if:user_type,2']
        ],
        [ 'required_if' => 'The :attribute is required.']);

        if ($this->image) {
            $imageUrl = $this->image->store('public/user');
            $this->image = Storage::url($imageUrl);
        }
        $user = User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'image' => $this->image,
            'is_admin' => $data['user_type'] == 1 ? 1 : 0,
            'user_type' => $data['user_type'],
            'password' => Hash::make(12345678),
        ]);

        if($user->user_type == 2) {
            TeacherDetail::query()->create([
                'user_id' => $user->id,
                'education' => $data['education'],
                'year_of_experience' => $data['year_of_experience'],
                'expertise' => $data['expertise'],
                'status' => 1
            ]);
        }

        if (!$user) {
            session()->flash('failed', 'User added failed!');
            return redirect()->route('user.create');
        }

        session()->flash('status', 'User successfully added!');
        return redirect()->route('user.create');
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
