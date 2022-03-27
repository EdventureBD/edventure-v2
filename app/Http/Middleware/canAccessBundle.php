<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// models
use App\Models\Admin\Bundle;
use App\Models\BundleStudentEnrollment;

class canAccessBundle
{
    public function handle(Request $request, Closure $next)
    {
        $bundle = $request->route('bundle');
        if(is_string($bundle)) 
            $bundle = Bundle::findOrFail($bundle);

        $bundle_student_enrollment = BundleStudentEnrollment::where('bundle_id', $bundle->id)->where('student_id', auth()->user()->id)->first();
        
        if ($bundle_student_enrollment) {
            return $next($request);
        }

        return redirect()->route('bundle-preview', $bundle->slug);
    }
}
