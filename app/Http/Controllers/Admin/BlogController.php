<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\RecipeIngredient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\CentralLogics\Helpers;

class BlogController extends Controller
{
    public function list(Request $request)
    {

        $blogs          = Blog::where('is_active', 'Y')->paginate(25);
        $total          =$blogs->total();
        return view('admin-views.blog.list',[
            'blogs'=>$blogs,
            'total'=>$total,
        ]);
    }
    public function edit(Request $request, $id)
    {
        $blog           = Blog::where('id', $id)->first();
        return view('admin-views.blog.edit', compact('blog'));
    }
    public function create(Request $request)
    {
        return view('admin-views.blog.create');
    }
    public function store(Request $request)
    {   
        
        try {
            $request->validate([
                'post_title'=>'required',
                'post_slug'=>'required'
            ]);
    
            $blog                       = new Blog();
            $blog->time_id              = date('U');
            $blog->post_title           = $request->post_title;
            $blog->slug                 = $request->post_slug;
            $blog->type                 = $request->type;
            $blog->meta_title           = $request->meta_title;
            $blog->meta_tags            = $request->meta_tags;
            $blog->meta_description     = $request->meta_description;
            $blog->content              = $request->content;
            if($request->hasFile('post_image')){
    
                $blog->image                = Helpers::upload('admin_feature/', 'png', $request->file('post_image'));
            }

            $blog->save();
          
          } catch (\Exception $e) {
            dd();
            //   dd($e->getMessage());
          }
        
        if($request->type == "Recipe"){
            
            $this->saveIngredients($blog->id, $request);
        }
        Toastr::success('Post has been added successfully');
        return redirect()->route('admin.blog.list');

    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'post_title'=>'required',
            'post_slug'=>'required'
        ]);

        $blog                       = Blog::with("RecipeIngredient")->find($id);
        $blog->post_title           = $request->post_title;
        $blog->slug                 = $request->post_slug;
        $blog->type                 = $request->type;
        $blog->meta_title           = $request->meta_title;
        $blog->meta_tags            = $request->meta_tags;
        $blog->meta_description     = $request->meta_description;
        $blog->content              = $request->content;
        if($request->hasFile('post_image')){
            $blog->image                = Helpers::upload('admin_feature/', 'png', $request->file('post_image'));
        }
        $blog->save();
        if($request->type == "Recipe"){
            $this->saveIngredients($blog->id, $request);
        }else{
            $blog->RecipeIngredient()->delete();
        }
        Toastr::success('Post has been updated successfully');
        return redirect()->route('admin.blog.list');

    }

    public function saveIngredients($blog_id, $request){
    
        $blog                       = Blog::find($blog_id);
        $rIngredient_name           = $request->ingrediant_name;
        $rIngredient_qty            = $request->ingrediant_qty;
        $ingredient_arr             = [];
        if(count($rIngredient_name) > 0){
            foreach($rIngredient_name as $key=>$name){

                $ingredient                 = new RecipeIngredient();
                $ingredient->ingredient     = $name;
                $ingredient->quantity       = $rIngredient_qty[$key];
                $ingredient_arr[]           = $ingredient;
            }
        }
        
        $blog->RecipeIngredient()->delete();
        $blog->RecipeIngredient()->saveMany($ingredient_arr);
    }
}
