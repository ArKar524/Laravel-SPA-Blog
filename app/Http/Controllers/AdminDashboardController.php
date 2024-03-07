<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        sleep(1.5);
        $categoriesCount = Category::count();
        $postsCount = Post::count();
        $userCount = User::count();
        return Inertia::render('Admin/Index', ['categoriesCount' => $categoriesCount, 'postCount' => $postsCount, 'userCount' => $userCount]);
    }
}