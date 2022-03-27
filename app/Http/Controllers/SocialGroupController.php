<?php

namespace App\Http\Controllers;

use App\Models\SocialGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SocialGroupController extends Controller
{
    public function index()
    {
        $lists = SocialGroup::query()->paginate(5);
        return view('admin.pages.social_group.index', compact('lists'));
    }

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required',
            'banner' => 'image|required',
            'link' => 'required'
        ]);


        if($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = rand().'_'.Carbon::today()->toDateString().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs(
                'socialBanner', $filename, 'public'
            );
            $inputs['banner'] = $filename;
        }

        SocialGroup::query()->create($inputs);
        return redirect()->back()->with('status','Added Successfully');
    }

    public function destroy($id)
    {
        $group = SocialGroup::query()->find($id);
        $group->delete();
        if($group->banner) {
            @unlink(public_path('storage/socialBanner/'.$group->banner));
        }
        return redirect()->back()->with('status','Deleted Successfully');
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->validate([
            'title' => 'required',
            'banner' => 'sometimes',
            'link' => 'required'
        ]);

        $group = SocialGroup::query()->find($id);

        if($request->hasFile('banner')) {
            $file = $request->file('banner');
            if($group->banner) {
                @unlink(public_path('storage/socialBanner/'.$group->banner));
            }

            $filename = rand().'_'.Carbon::today()->toDateString().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs(
                'socialBanner', $filename, 'public'
            );
            $inputs['banner'] = $filename;
        }

        SocialGroup::query()->where('id', $id)->update($inputs);

        return redirect()->back()->with('status','Updated Successfully');
    }
}
