<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        sleep(1.5);
        $post = Post::orderBy('created_at', 'desc')->get();
        $postUMayLike = Post::orderBy('created_at', 'asc')->Limit(4)->get();
        $category = Category::all();
        return Inertia::render('Ui/Index', ['post' => $post, 'category' => $category, 'postUMayLike' => $postUMayLike]);
    }

    public function details($id)
    {
        sleep(1.5);


        $post = Post::find($id);
        $likes = Like::where('post_id', $id)->count();
        // dd($likes);
        if (Auth::check()) {
            $like = Like::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
        } else {
            $like = Like::where('post_id', $id)->first();

        }
        // dd($like);
        $commentsCount = Comment::where('post_id', $id)->count();
        $postUMayLike = Post::orderBy('created_at', 'asc')->Limit(4)->get();
        $category = Category::all();
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->with('user')->get();
        // dd($likes);
        return Inertia::render('Ui/blog-detail', ['post' => $post, 'category' => $category, 'postUMayLike' => $postUMayLike, 'comments' => $comments, 'like' => $like, 'likes' => $likes, 'commentsCount' => $commentsCount]);
    }

    public function searchByCategory(Request $request, $id)
    {
        sleep(1.5);

        $post = Post::where('category_id', $id)->get();
        // dd($post);
        $postUMayLike = Post::orderBy('created_at', 'asc')->Limit(4)->get();
        $category = Category::all();
        $comments = Comment::with('user')->get();
        // dd($comments);
        return Inertia::render('Ui/Index', ['post' => $post, 'category' => $category, 'postUMayLike' => $postUMayLike, 'comments' => $comments]);
    }
}