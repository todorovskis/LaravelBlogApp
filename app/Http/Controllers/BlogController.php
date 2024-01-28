<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('dashboard', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with('user', 'comments.user')->findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = "test";
        $blog->user_id = auth()->user()->id;
        $blog->save();

        return redirect()->route('dashboard')->with('success', 'Blog post created successfully!');

    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('create', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->save();

        return redirect()->route('dashboard', ['blog' => $blog->id])
            ->with('success', 'Blog post updated successfully');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('dashboard');
    }
}
