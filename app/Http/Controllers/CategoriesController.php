<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic)
    {
        // Get topics in specific category
        $topics = $topic->withOrder($request->order)->where('category_id', $category->id)->paginate(20);
        // Send variables to view
        return view('topics.index', compact('topics', 'category'));
    }
}
