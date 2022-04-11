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
    public $show = false;

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

    protected $rules = [
        'name' => 'string|required|max:325',
        'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        'email' => 'email:rfc,dns|unique:users|required',
        'phone' => 'required|numeric|digits:11',
        'user_type' => 'required',
        'education' => ['required_if:user_type,2'],
        'year_of_experience' => ['required_if:user_type,2'],
        'expertise' => ['required_if:user_type,2']
//        'regex:~^([a-z0-9]+,)+$~i'
    ];

    protected $customMessages = [
        'required_if' => 'The :attribute is required.',
        'expertise.regex' => "The :attribute format is invalid. It should be 'comma(,)' seperated"
    ];

    public function saveUser()
    {
        $data = $this->validate($this->rules, $this->customMessages);

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
            $this->createTeacherDetails($user,$data);
        }

        if (!$user) {
            session()->flash('failed', 'User added failed!');
            return redirect()->route('user.create');
        }

        $label = $user->user_type == 1 ? 'Admin' : ($user->user_type == 2 ? 'Teacher' : 'Student');
        session()->flash('status', $label.' added successfully!');
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

    public function changeEvent($value)
    {
        if($value == 2) {
            return $this->show = true;
        } else {
            return $this->show = false;
        }
    }

    public function createTeacherDetails($user,$data)
    {
        TeacherDetail::query()->create([
            'user_id' => $user->id,
            'education' => $data['education'],
            'year_of_experience' => $data['year_of_experience'],
            'expertise' => $data['expertise'],
            'status' => 1
        ]);
    }

}
