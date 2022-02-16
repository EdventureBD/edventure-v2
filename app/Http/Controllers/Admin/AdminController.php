<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    }
}
