<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activites = Activity::orderBy('created_at', 'DESC')->get();
        return view('admin.pages.activity.index', compact('activites'));
    }
}
