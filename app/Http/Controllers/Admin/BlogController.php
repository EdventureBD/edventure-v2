<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.pages.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereUserType(2)->get();
        return view('admin.pages.blog.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'subTitle' => 'required|string',
            'description' => 'required|',
            'authorId' => 'required|',
            'banner' => 'required|image|mimes:jpeg,jpg,png|',
            'meta_tag' => 'nullable|',
            'meta_description' => 'nullable|',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = (string) Str::uuid();
        $blog->subTitle = $request->subTitle;
        if ($request->hasFile('banner')) {
            $blog->banner = Storage::url($request->banner->store('public/blog'));
        }
        $blog->meta_tag = $request->meta_tag;
        $blog->meta_description = $request->meta_description;
        $blog->description = $request->description;
        $blog->author_id = $request->authorId;
        $blog->status = 1;

        $save = $blog->save();
        if ($save) {
            return redirect()->route('blog.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $users = User::whereUserType(2)->get();
        return view('admin.pages.blog.edit', compact('blog', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $validateData = $request->validate([
            'title' => 'required|string',
            'subTitle' => 'required|string',
            'description' => 'required|',
            'authorId' => 'required|',
            'banner' => 'image|mimes:jpeg,jpg,png|',
            'meta_tag' => 'nullable|',
            'meta_description' => 'nullable|',
        ]);

        $blog->title = $request->title;
        $blog->subtitle = $request->subTitle;
        if ($request->hasFile('banner')) {
            $fileName = substr($blog->banner, 14);
            $delete = Storage::delete('public/blog/' . $fileName);
            if ($delete) {
                $blog->banner = Storage::url($request->banner->store('public/blog'));
            }
        }
        $blog->meta_tag = $request->meta_tag;
        $blog->meta_description = $request->meta_description;
        $blog->description = $request->description;
        $blog->author_id = $request->authorId;

        $save = $blog->save();
        if ($save) {
            return redirect()->route('blog.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $delete = $blog->delete();
        if ($delete) {
            return redirect()->back();
        }
    }

    public function changeBlogStatus(Request $request)
    {
        $obj = Blog::find($request->id);
        $obj->status = $request->status;
        $obj->save();

        return response()->json(['success' => 'Status change successfully.']);
    }


    public function readBlog(Blog $blog)
    {
        if ($blog->status == 0) {
            return redirect()->route('home');
        } else {
            $author = User::where('id', $blog->author_id)->select('name', 'image')->first();
            $author_name = $author->name;
            $author_image = $author->image;
            $title = $blog->title;
            $banner = $blog->banner;
            $subtitle = $blog->subtitle;
            $description = $blog->description;
            return view('landing.read_blog', compact(
                'author_name',
                'author_image',
                'title',
                'banner',
                'subtitle',
                'description'
            ));
        }
    }
}
