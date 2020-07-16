<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;


class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('visitatore.posts.index', compact('posts'));
    }

    public function show($slug) {
        $post = Post::where('slug', $slug)->first();
        if($post) {
            return view('visitatore.posts.show', compact('post'));
        } else {
            return abort('404');
        }
    }

    public function category($slug) {
        $category = Category::where('slug', $slug)->first();
        if($category) {
            // recupero i post di questa categoria
            $posts = $category->posts;
            $data = [
                'category' => $category,
                'posts' => $posts
            ];
            return view('visitatore.posts.category', $data);
        } else {
            return abort('404');
        }
    }
}
