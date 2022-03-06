<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// models
use App\Models\Admin\Bundle;
use App\Models\BundleStudentEnrollment;

class canAccessBundle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bundle = $request->route('bundle');
        if(is_string($bundle)) $batch = Bundle::findOrFail($bundle);

        $bundle_student_enrollment = BundleStudentEnrollment::where('bundle_id', $bundle->id)->where('student_id', auth()->user()->id)->first();

        // dd($bundle, $bundle_student_enrollment);

        // dd($batch_student_enrollment);
        if ($bundle_student_enrollment) {
            return $next($request);
        }

        return redirect()->route('bundle-preview', $bundle->slug);
    }
}
