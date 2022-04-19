<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('landing.contact_us');
    }

    public function store(Request $request)
    {
        $inputs =  $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        ContactUs::query()->create($inputs);
        return redirect()->back()->with('success', 'Your Information Successfully Submitted');

    }

    public function adminIndex()
    {
        $contacted_list = ContactUs::query()->orderByDesc('created_at')->paginate(6);
        return view('admin.pages.contact_us.index', compact('contacted_list'));
    }
}
