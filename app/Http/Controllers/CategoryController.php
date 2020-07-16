<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('visitatore.categories.index', compact('categories'));
    }

    public function show($slug) {
        $category = Category::where('slug', $slug)->first();
        if($category) {
            //recupero tutti i post di una categoria
            $posts = $category->posts; //è una collection di oggetti post
            $data = [
                'category' => $category,
                'posts' => $posts
            ];
            return view('visitatore.categories.show', $data);
        } else {
            return abort('404');
        }
    }
}
