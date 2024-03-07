<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        sleep(1);
        $posts = Post::with('category')->get();
        return Inertia::render("Admin/Post/Index", ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        sleep(1.2);

        $categories = Category::all();
        return Inertia::render("Admin/Post/Create", ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        sleep(1.2);

        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);

        $image = $request->image;
        $imageName = uniqid() . '_' . $image->getClientOriginalName();

        $image->storeAs('public/post/', $imageName);

        Post::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
        ]);
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        $post = Post::find($id);
        $commentCount = Comment::where('post_id', $id)->count();
        $likeCount = Like::where('post_id', $id)->count();
        $like = Like::where('post_id', $id)->orderBy('created_at', 'desc')->with('user')->get();
        $comment = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->with('user')->get();
        return Inertia::render("Admin/Post/Detail", ['post' => $post, 'comment' => $comment, 'commentCount' => $commentCount, 'likeCount' => $likeCount, 'like' => $like]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        sleep(1.2);

        $categories = Category::all();
        $post = Post::find($id);
        return Inertia::render('Admin/Post/Edit', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function postUpdate(Request $request, string $id)
    {
        sleep(1.2);

        // dd($request->image);
        $post = Post::find($id);
        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable',
        ]);
        if ($request->hasFile('image')) {

            // dd($request->all());
            $image = $request->image;
            $imageName = uniqid() . '_' . $image->getClientOriginalName();

            $image->storeAs('/public/post/', $imageName);
            Storage::delete('/public/post/' . $post->image);

            $post->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imageName,
            ]);
        } else {
            $post->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }


        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        sleep(1.2);

        $post = Post::find($id);
        // dd($post->image);
        if ($post->image) {
            Storage::delete('/public/post/' . $post->image);
        }
        $post->delete();

        return redirect('/admin/posts');
    }

    public function category()
    {
        sleep(1);
        $categories = Category::all();
        return Inertia::render('Admin/Category/Index', ['categories' => $categories]);
    }
    public function categoryCreate()
    {
        sleep(1.2);
        return Inertia::render('Admin/Category/Create');
    }
    public function categoryStore(Request $request)
    {
        sleep(1.2);
        $data = $request->validate([
            'name' => 'required',
        ]);
        Category::create($data);
        return redirect('/admin/categories');
    }
    public function categoryEdit($id)
    {
        sleep(1.2);
        $category = Category::find($id);
        return Inertia::render('Admin/Category/Edit', ['category' => $category]);
    }
    public function categoryUpdate(Request $request, $id)
    {
        sleep(1.2);

        $data = $request->validate([
            'name' => 'required',
        ]);
        $category = Category::find($id);
        $category->update($data);
        return redirect('/admin/categories');
    }
    public function categoryDelete(string $id)
    {
        sleep(1.2);
        // dd($id);
        Category::destroy($id);

        return redirect('/admin/categories');
    }

}