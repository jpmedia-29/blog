<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Like;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index()
    {
         $blogs = Blog::join('users', 'blogs.user_id', '=', 'users.id')
                    ->select('blogs.*', 'users.name as author_name')
                     ->get();
        return view('index',compact('blogs'));
    }

    public function view_blog()
    {
        $blogs = Blog::all();
        return view('admin/blog',['blogs'=>$blogs]);
    }


    public function create()
    {
        return view('admin/create_blog');
    }


    public function blog_detail($slug)
    {

         $blog = Blog::with('comments.user') 
        ->join('users', 'blogs.user_id', '=', 'users.id')
        ->select('blogs.*', 'users.name as author_name')
        ->where('slug', $slug)
        ->firstOrFail();
        return view('blog_detail', compact('blog'));
    }


    public function like($blog_id)
    {
        $user_id = auth()->id(); 
        $like = Like::where('user_id', $user_id)->where('blog_id', $blog_id)->first();
    
        if ($like) {
            $like->delete();
            $status = 'unliked'; 
            DB::table('blogs')->where('id', $blog_id)->decrement('like_count');
        } else {
            Like::create([
                'user_id' => $user_id,
                'blog_id' => $blog_id,
            ]);
            $status = 'liked';  
            DB::table('blogs')->where('id', $blog_id)->increment('like_count');
        }
        $blog = DB::table('blogs')->where('id', $blog_id)->first(['like_count']);
        return response()->json([
            'like_count' => $blog->like_count,
            'status' => $status,
        ]);
    }
    
    
    


    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $slug = Str::slug($validated['title']);
        $existingSlugCount = Blog::where('slug', $slug)->count();
        if ($existingSlugCount > 0) {
            $slug = $slug . '-' . ($existingSlugCount + 1);
        }
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
    
        Blog::create([
            'title' => $validated['title'],
            'slug' => $slug,  
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'image' => $imagePath,
        ]);
        
        return redirect()->route('blog.view_blog')->with('success', 'Blog baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);
        $slug = Str::slug($validated['title']);
        $existingSlugCount = Blog::where('slug', $slug)->where('id', '!=', $blog->id)->count();
        if ($existingSlugCount > 0) {
            $slug = $slug . '-' . ($existingSlugCount + 1);
        }
        if ($request->hasFile('image')) {

            if ($blog->image) {
                Storage::delete($blog->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {

            $imagePath = $blog->image;
        }
        $blog->update([
            'title' => $validated['title'],
            'slug' => $slug, 
            'content' => $validated['content'],
            'image' => $imagePath,
        ]);
        
        return redirect()->route('blog.view_blog')->with('success', 'Blog berhasil diperbarui.');
    }


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin/edit_blog',['blog'=>$blog]);
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blog.view_blog')->with('succes','Blog Berhasil Dihapus');
    }
    
}
