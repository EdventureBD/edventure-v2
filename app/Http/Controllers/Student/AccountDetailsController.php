<?php

namespace App\Http\Controllers\student;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Admin\BatchStudentEnrollment;
use App\Models\Student\StudentDetails;

class AccountDetailsController extends Controller
{
    public function index($id)
    {
        if (auth()->user()->id == $id) {
            $studentDetails = StudentDetails::where('user_id', $id)->first();
            if ($studentDetails) {
                $user = User::join('student_details', 'student_details.user_id', 'users.id')
                    ->select('users.*', 'student_details.*')
                    ->where('users.id', $id)->first();
            } else {
                $user = User::where('id', $id)->first();
            }
            $batchStudentEnrollment = BatchStudentEnrollment::where('student_id', auth()->user()->id)->get();
            $batchStudentEnroll = $batchStudentEnrollment;
            $batchStudent = $batchStudentEnrollment;
            return view('student.pages.user.profile', compact(
                'user',
                'batchStudentEnrollment',
                'batchStudentEnroll',
                'batchStudent'
            ));
        } else {
            abort(401);
        }
    }

    public function edit($id)
    {
        if (auth()->user()->id == $id) {
            $user = User::where('id', $id)->first();
            $studentDetails = StudentDetails::where('user_id', $id)->first();
            return view('student.pages.user.edit_profile', compact('user', 'studentDetails'));
        } else {
            abort(401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->id == $id) {
            $validate = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
                'gender' => 'required|string|',
                'contact' => 'required|numeric|',
                'class' => 'required|',
                'institution' => 'required|string',
                'district' => 'nullable|string',
                'address' => 'required|string',
                'gaurdianContactNo' => 'nullable|numeric',
                'relationWithGaurdian' => 'nullable|string',
            ]);
            $save = DB::table('student_details')
                ->updateOrInsert(
                    ['user_id' => $id],
                    [
                        'user_id' => $id,
                        'image' => $request->image,
                        'gender' => $request->gender,
                        'contact' => $request->contact,
                        'class' => $request->class,
                        'institution' => $request->institution,
                        'district' => $request->district,
                        'address' => $request->address,
                        'gaurdian_contact_no' => $request->gaurdianContactNo,
                        'relation_with_gaurdian' => $request->relationWithGaurdian,
                    ],
                );
            return redirect()->route('profile', $id)->with('status', 'Profile updated successfully');
        } else {
            abort(401);
        }
    }
}
