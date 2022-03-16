<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminIndex()
    {
        return view('admin.pages.admin');
    }

    public function updatePassword()
    {
        return view('admin.pages.update-password');
    }

    public function submitUpdatePassword(Request $request)
    {
        $inputs = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (!Hash::check($inputs['current_password'], auth()->user()->getAuthPassword())) {
            return redirect()->back()->with(['failed' => 'Your current password does not match']);
        }

        if(Hash::check($inputs['password'], auth()->user()->getAuthPassword())) {
            return redirect()->back()->with(['failed' => 'Your have entered your old password']);
        }

        auth()->user()->password = Hash::make($inputs['password']);
        auth()->user()->save();
        return redirect()->back()->with(['status' => 'Your password updated successfully']);
    }
}
