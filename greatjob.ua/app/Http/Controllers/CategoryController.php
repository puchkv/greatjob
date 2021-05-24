<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Task;

class CategoryController extends Controller
{
    public function index()
    {
    	$categories = Category::with('subCategories')
            ->whereNull('parent_id')->get();
    	return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $tasks = $category->tasks()->where('status', 'open')->paginate(15);
    	return view('categories.show', compact('category', 'tasks'));
    }
}
