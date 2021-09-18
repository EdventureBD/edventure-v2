<?php

namespace App\Http\Livewire\Student\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Student\StudentDetails;

class EditProfile extends Component
{
    use WithFileUploads;

    public $user;

    public $userId;
    public $image;
    public $tempImage;
    public $gender;
    public $contact;
    public $class;
    public $institution;
    public $district;
    public $address;
    public $gaurdianContactNo;
    public $relationWithGaurdian;

    public  $studentDetails;

    protected $rules = [
        'tempImage' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        'gender' => 'required|string|',
        'contact' => 'required|numeric|',
        'class' => 'required|',
        'institution' => 'required|string',
        'district' => 'nullable|string',
        'address' => 'required|string',
        'gaurdianContactNo' => 'nullable|numeric',
        'relationWithGaurdian' => 'nullable|string',
    ];

    public function updatedTempImage()
    {
        $this->image = '';
    }

    public function editAccount()
    {
        // dd("enan");
        $data = (object)($this->validate());
        // dd($data);
        if ($data->tempImage) {
            $imageUrl = $this->tempImage->store('public/student');
            $this->tempImage = $imageUrl;
        }
        $save = DB::table('student_details')
            ->updateOrInsert(
                ['user_id' => $this->user->id],
                [
                    'user_id' => $this->user->id,
                    'image' => $this->tempImage,
                    'gender' => $data->gender,
                    'contact' => $data->contact,
                    'class' => $data->class,
                    'institution' => $data->institution,
                    'district' => $data->district,
                    'address' => $data->address,
                    'gaurdian_contact_no' => $data->gaurdianContactNo,
                    'relation_with_gaurdian' => $data->relationWithGaurdian,
                ],
            );
        if ($save) {
            session()->flash('status', 'Profile updated successfully');
            return redirect()->route('profile', $this->user->id);
        } else {
            session()->flash('failed', 'Profile updated failed!');
            return redirect()->route('admin.settings');
        }
    }

    public function mount()
    {
        $this->studentDetails = StudentDetails::where('user_id', $this->user->id)->first();
        if (!empty($this->studentDetails)) {
            $this->userId = $this->studentDetails->user_id;
            if ($this->studentDetails->image) {
                $this->image = $this->studentDetails->image;
            }
            $this->gender = $this->studentDetails->gender;
            $this->contact = '0' . $this->studentDetails->contact;
            $this->class = $this->studentDetails->class;
            $this->institution = $this->studentDetails->institution;
            $this->district = $this->studentDetails->district;
            $this->address = $this->studentDetails->address;
            if ($this->studentDetails->gaurdian_contact_no) {
                $this->gaurdianContactNo = '0' . $this->studentDetails->guardian_contact_no;
            }
            if ($this->studentDetails->relation_with_gaurdian) {
                $this->relationWithGaurdian = $this->studentDetails->relation_with_guardian;
            }
        }
        // dd($this->image);
    }

    public function render()
    {
        return view('livewire.student.user.edit-profile');
    }
}
