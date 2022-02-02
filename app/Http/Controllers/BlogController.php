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
		$blogs = Blog::where('status',1)->orderBy('id', 'desc')->paginate(10);

        $tagsArray = [];
        foreach($blogs as $blog){
                foreach(explode(',', $blog->tags) as $singleBlog){
                    if(count($tagsArray) <= 6){
                    array_push($tagsArray, $singleBlog);
                    }
                }
        }
        $blog_categories = BlogCategory::inRandomOrder()->get();
        return view('front.pages.blogs',compact('blogs','blog_categories', 'tagsArray'));
    }

    public function blogCategories($slug)
    {
        $category = BlogCategory::where('slug', $slug)->first();
        $category_blogs = Blog::where('category_id', $category->id)->get();
        $blog_categories = BlogCategory::inRandomOrder()->get();

        $blogs = Blog::where('status',1)->orderBy('id', 'desc')->where('category_id', $category->id)->paginate(getcong('pagination_limit'));

        return view('front.pages.blog_categories',compact('category','blogs', 'category_blogs', 'blog_categories'));
    }


    public function blogDetail($slug)
    {
        $blog = Blog::with(['user'])->where('slug',$slug)->firstOrFail();
        $blogs = Blog::where('status',1)->orderBy('id', 'desc')->limit(9)->get();
        $blog_categories =  DB::table('blogs_categories')
            ->join('blogs', "blogs_categories.id", "blogs.category_id")
            ->select('blogs_categories.id', 'blogs_categories.*', DB::Raw('COUNT(blogs.category_id) as pcount'))
            
            ->groupBy("blogs_categories.id")
            ->orderBy("pcount", "desc")
            ->get();

        return view('front.pages.blog_detail',compact('blog','blogs','slug','blog_categories'));
    }

    public function searchBlogs(Request $request)
    {

        $inputs = $request->all();
        $keyword = $inputs['keyword'];

        $blog_categories = BlogCategory::get();

        $blogs = Blog::where('status',1)->
            where(function ($query) use ($keyword) {
            $query->where('title', 'like', '%'.$keyword.'%')
            ->orWhere('description', 'like', '%'.$keyword.'%');
        })->paginate(getcong('pagination_limit'));


        return view('front.pages.blogs',compact('blogs','blog_categories'));
    }
    public function searchBlogCategories(Request $request, $id)
    {   
        $inputs = $request->all();
        $keyword = $inputs['keyword'];
        $category = BlogCategory::find($id);
        $category_blogs = Blog::where('category_id', $category->id)->
        where('status',1)->
        where(function ($query) use ($keyword) {
            $query->where('title', 'like', '%'.$keyword.'%')
            ->orWhere('description', 'like', '%'.$keyword.'%');
        })->get();
        $blog_categories = BlogCategory::get();
        $blogs = Blog::where('status',1)->orderBy('id', 'desc')->where('category_id', $category->id)->paginate(getcong('pagination_limit'));
        
        return view('front.pages.blog_categories',compact('blogs','blog_categories','category_blogs','blogs','category'));
    }


}
