<?php

namespace App\Http\Controllers;

use App\Auction;
use App\Category;
use App\subcat;
use App\subsub;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{


    public function index()
    {
        $categories=Category::all();
        return view('admin.pages.category.manage',['categories'=>$categories]);
    }


    public function create()
    {

       return view('admin.pages.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'status'=>'required'
        ]);

     $category=new Category();
     $category->name=$request->name;
     $category->description=$request->description;
        if ($request->hasfile('category_image')) {
            $image = $request->file('category_image');
            $filename = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/'), $filename);
            $category->category_image = $filename;
        }
        $category->cat_order=$request->cat_order;
        $category->status=$request->status;
        $category->save();
        return redirect('/admin/category/create')
            ->with(['type'=>'success','message'=>'Category created Successfully']);
    }


    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $category=Category::find($id);
        return view('admin.pages.category.edit',['category'=>$category, 'id'=>$id]);
    }


    public function update(Request $request, $id){

        $request->validate([
            'name'=>'required',
            'status'=>'required'
        ]);
        $category=Category::find($id);
        $category->name=$request->name;
        $category->description=$request->description;
        $image_name = $request->hidden_image;

        if ( $image_name== null) {
            if ($request->hasfile('category_image')) {
                $image = $request->file('category_image');
                $filename = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/'), $filename);
                $category->category_image = $filename;
            }
        }
        else {
            if ($request->hasfile('category_image')) {

                $image = $request->file('category_image');
                unlink(public_path('images/') . $image_name);
                $filename = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/'), $filename);
                $category->category_image = $filename;

            } else {
                $category->category_image = $image_name;
            }
        }
        $category->cat_order=$request->cat_order;
        $category->status=$request->status;

        $category->save();
       return redirect('/admin/category')
           ->with(['type'=>'success','message'=>'Category Updated Successfully']);
    }


    public function destroy($id)
    {

        $subcat=DB::table('subcats')
            ->select('id')
            ->where('category_id','=',$id)
            ->get();



        if(sizeof($subcat)>0)
        {
            $sub=DB::table('subsubs')
                ->select('id')
                ->where('subcat_id','=',$subcat[0]->id)
                ->get();
            if(sizeof($sub)>0) {
                for ($i = 0; $i < sizeof($subcat); $i++) {
                    $subsub = DB::table('subsubs')
                        ->select('id')
                        ->where('subcat_id', '=', $subcat[$i]->id)
                        ->get();
                    $sub = subsub::find($subsub[$i]->id);
                    $sub->delete();
                }
            }
            else {
                for ($i = 0; $i < sizeof($subcat); $i++) {
                    $subc = subcat::find($subcat[$i]->id);
                    $subc->delete();
                }
            }
        }

        $category=Category::find($id);
        unlink(public_path('images/') .$category->category_image);
        $category->delete();
        return back()
            ->with(['type'=>'success','message'=>'Category deleted successfully']);

    }



}
