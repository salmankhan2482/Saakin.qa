<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\Blog;
use App\BlogCategory;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        $blogs = Blog::paginate(10);
        $action = 'saakin_index';
        return view('admin-dashboard.blog.index',compact('blogs','action'));
    }

    public function create()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $categories = BlogCategory::all();
        $action = 'saakin_create';
        return view('admin-dashboard.blog.create', compact('categories','action'));
    }

    public function store(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'blog_image' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $blog = new Blog();

        $blog->user_id = Auth::User()->id;
        $blog->category_id = $inputs['category'];
        $blog->title = $inputs['title'];
        $blog_slug = Str::slug($inputs['title'], "-");
        $blog->slug = $blog_slug;
        $blog->description = $inputs['description'];
        $blog->created_at = date("Y-m-d H:i:s");
        $blog_image = $request->file('blog_image');     

        if($blog_image) 
        {
            $tmpFilePath = public_path('upload/blogs/');
            $blog_image_name = $blog_image->getClientOriginalName();
            $blog_image_name = explode(".",$blog_image_name);
            $name = 'blog_'.time().'.'.$blog_image->extension();
            $blog_image->move($tmpFilePath, $name);            
            $blog->image = $name;

            //Image resizeing 
            $thumbPath = public_path('upload/blogs/thumbnail/');
            $image_original_path = $tmpFilePath.$name;
            $image_resize = Image::make($image_original_path);              
            $image_resize->resize(365,196);
            $resize = $thumbPath.$name;            
            $image_resize->save($resize);
        }   
        $blog->meta_title = $request->meta_title;   
        $blog->meta_description = $request->meta_description; 
        $blog->meta_keywords = $request->meta_keyword;
        $blog->tags = $request->tags;

        $blog->save();

        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function edit($id)
    {
        if(Auth::User()->usertype!="Admin") {
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $categories = BlogCategory::all();
        $blog = Blog::findOrFail($id);
        return view('admin.pages.edit_blog',compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $blog = Blog::findOrFail($id);
      
        $blog->category_id = $inputs['category'];
        $blog->title = $inputs['title'];
        $blog_slug = Str::slug($inputs['title'], "-");
        $blog->slug = $blog_slug;
        $blog->description = $inputs['description'];


        $blog_image = $request->file('blog_image');     

        if($blog_image) 
        {
            $tmpFilePath = public_path('upload/blogs/');
            $blog_image_name = $blog_image->getClientOriginalName();
            $blog_image_name = explode(".",$blog_image_name);

            $name = 'blog_'.time().'.'.$blog_image->extension();
            $blog_image->move($tmpFilePath, $name);            
            $blog->image = $name;

            //Image resizeing 
            $thumbPath = public_path('upload/blogs/thumbnail/');
            $image_original_path = $tmpFilePath.$name;
            $image_resize = Image::make($image_original_path);              
            $image_resize->resize(365,196);
            $resize = $thumbPath.$name;            
            $image_resize->save($resize);
        }   
        $blog->meta_title = $request->meta_title;   
        $blog->meta_description = $request->meta_description; 
        $blog->meta_keywords = $request->meta_keyword;
        $blog->tags = $request->tags;

        $blog->save();

        \Session::flash('flash_message', trans('words.updated'));
        return \Redirect::back();
    }

    public function destroy($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $blog = Blog::findOrFail($id);

        $blog->delete();

        \File::delete(public_path() .'/upload/blogs/'.$blog->image);

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
    }


    public function listBlogCategory()
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('dashboard');
        }

        $blogCategories = BlogCategory::paginate(10);

        return view('admin.pages.blog_categories',compact('blogCategories'));
    }

    public function createBlogCategory()    {

        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        return view('admin.pages.add_blog_category');
    }

    public function storeBlogCategory(Request $request)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'name' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $blogCategory = new BlogCategory();
        $blogCategory->category = $inputs['name'];
        $slug = Str::slug($inputs['name'], "-");
        $blogCategory->slug = $slug;
        $blogCategory->description = $inputs['description'];

        /*$city_image = $request->file('city_image1');
        if($city_image) {
            $city_image_name = $city_image->getClientOriginalName();
            $city_image_name = explode(".",$city_image_name);
            $tmpFilePath = public_path('upload/cities/');
            $imageName = $city_image_name[0].'_'.time().'.'.$city_image->extension();
            $city_image->move($tmpFilePath, $imageName);
            $city_image_new_name1 = $imageName;
            $blogCategory->image1 = $city_image_new_name1;
        }*/

        $blogCategory->save();

        \Session::flash('flash_message', trans('words.added'));
        return \Redirect::back();
    }

    public function editBlogCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.pages.edit_blog_category',compact('blogCategory'));
    }

    public function updateBlogCategory(Request $request, $id)
    {
        $data =  \Request::except(array('_token')) ;

        $inputs = $request->all();

        $rule=array(
            'name' => 'required',
        );

        $validator = \Validator::make($data,$rule);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->messages());
        }

        $blogCategory = BlogCategory::findOrFail($id);
        $blogCategory->category = $inputs['name'];
        $slug = Str::slug($inputs['name'], "-");
        $blogCategory->slug = $slug;
        $blogCategory->description = $inputs['description'];

        $blogCategory->save();

        \Session::flash('flash_message', trans('words.updated'));
        return \Redirect::back();
    }

    public function destroyBlogCategory($id)
    {
        if(Auth::User()->usertype!="Admin"){
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');
        }

        $blogCategory = BlogCategory::findOrFail($id);

        $blogCategory->delete();

        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();
    }
}
