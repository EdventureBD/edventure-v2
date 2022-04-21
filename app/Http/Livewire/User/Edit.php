<?php

namespace App\Http\Livewire\User;

use App\Models\TeacherDetail;
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
    public $education;
    public $year_of_experience;
    public $expertise;
    public $show = true;

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
        'user_type' => 'required',
        'education' => ['required_if:user_type,2'],
        'year_of_experience' => ['required_if:user_type,2'],
        'expertise' => ['required_if:user_type,2']
    ];

    protected $customMessages = [
        'required_if' => 'The :attribute is required.',
        'expertise.regex' => "The :attribute format is invalid. It should be 'comma(,)' seperated"
    ];

    public function saveUser()
    {
        $data = $this->validate($this->rules, $this->customMessages);
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
        $user->is_admin = $data['user_type'] == 1 ? 1 : 0;
        $user->user_type = $data['user_type'];

        if($data['user_type'] == 2) {
            if($user->teacherDetails) {
                $user->teacherDetails->education = $data['education'];
                $user->teacherDetails->year_of_experience = $data['year_of_experience'];
                $user->teacherDetails->expertise = $data['expertise'];
                $user->teacherDetails->save();
            } else {
                TeacherDetail::query()->create([
                    'user_id' => $user->id,
                    'status' => 1,
                    'education' => $data['education'],
                    'year_of_experience' => $data['year_of_experience'],
                    'expertise' => $data['expertise'],
                ]);
//                $user->teacherDetails->user_id = $user->id;
//                $user->teacherDetails->status = 1;
//                $user->teacherDetails->education = $data['education'];
//                $user->teacherDetails->year_of_experience = $data['year_of_experience'];
//                $user->teacherDetails->expertise = $data['expertise'];
            }
        }

        $save = $user->save();

        $label = $user->user_type == 1 ? 'Admin' : ($user->user_type == 2 ? 'Teacher' : 'Student');

        if ($save) {
            session()->flash('status', $label.' updated successfully!');
            return redirect()->route('user.edit', $this->user->id);
        } else {
            session()->flash('status', $label.' updated failed!');
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
        $this->education = data_get($this->user->teacherDetails,'education');
        $this->year_of_experience = data_get($this->user->teacherDetails,'year_of_experience');
        $this->expertise = data_get($this->user->teacherDetails,'expertise');

        $this->user_types = UserType::all();

        if($this->user->user_type == 2) {
            return $this->show = true;
        } else {
            return $this->show = false;
        }
    }

    public function render()
    {
        return view('livewire.user.edit');
    }

    public function changeEvent($value)
    {
        if($value == 2) {
            return $this->show = true;
        } else {
            return $this->show = false;
        }
    }
}
