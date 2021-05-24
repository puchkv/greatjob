<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Task;
class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $categories = Category::with('subCategories')
            ->whereNull('parent_id')->get();

        $tasks = Task::orderBy('created_at', 'desc')->where('status', 'OPEN')->take(3)->get();

        return view('index', compact('categories', 'tasks'));
    }
}
