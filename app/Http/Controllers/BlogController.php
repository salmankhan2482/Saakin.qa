<?php

namespace App\Http\Controllers;

use App\Blog;
use App\User;
use App\Properties;
use App\Agency;
use App\BlogCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Str;

class BlogController extends Controller
{
	public function __construct()
    {
       //  check_property_exp();
    }

    public function index()
    {
		$blogs = Blog::where('status',1)->when(request('keyword'), function($query){
            $query->where('title', 'like', '%'.request('keyword').'%')
            ->orWhere('description', 'like', '%'.request('keyword').'%');
        })
        ->where('status', 1)
        ->orderBy('id','desc')->paginate(10);
        
        $popularposts = Blog::where('status',1)->orderBy('count', 'desc')->limit(9)->get();
        
        $categories = BlogCategory::inRandomOrder()->get();
        return view('front.pages.blogs',compact('blogs','categories','popularposts'));
    }

    public function blogCategories($slug)
    {
        $category = BlogCategory::where('slug', $slug)->first();
        $categories = BlogCategory::inRandomOrder()->get();

        $category_blogs = Blog::where('status',1)->orderBy('id', 'desc')
        ->where('category_id', $category->id)
        ->paginate(getcong('pagination_limit'));
        
        $popularposts = Blog::where('status',1)->orderBy('count', 'desc')->limit(5)->get();

        return view('front.pages.blog_categories',compact('category', 'category_blogs','popularposts','categories'));
    }


    public function blogDetail($slug)
    {
        $blog = Blog::with(['user'])->where('status', 1)->where('slug',$slug)->firstOrFail();
        $blog->increment('count');
        $blog->update();

        $popularposts = Blog::where('status',1)->orderBy('count', 'desc')->limit(5)->get();
        $recentposts = Blog::where('status',1)->orderBy('id', 'desc')->limit(5)->get();
        
        $categories =  DB::table('blogs_categories')
        ->join('blogs', "blogs_categories.id", "blogs.category_id")
        ->select('blogs_categories.id', 'blogs_categories.*', DB::Raw('COUNT(blogs.category_id) as pcount'))
        ->groupBy("blogs_categories.id")
        ->where('blogs.status', 1)
        ->orderBy("pcount", "desc")
        ->get();
        return view('front.pages.blog_detail',compact('blog','popularposts', 'recentposts', 'slug','categories'));
    }

    public function searchBlogCategories(Request $request, $id)
    {   
        $inputs = $request->all();
        $keyword = $inputs['keyword'];
        $category = BlogCategory::find($id);

        $category_blogs = Blog::where('category_id', $category->id)
        ->where('status',1)
        ->where(function ($query) use ($keyword) {
            $query->where('title', 'like', '%'.$keyword.'%')
            ->orWhere('description', 'like', '%'.$keyword.'%');
        })->paginate(getcong('pagination_limit'));
        

        $categories = BlogCategory::get();
        return view('front.pages.blog_categories',compact('blogs','categories','category_blogs','category'));
    }


}
