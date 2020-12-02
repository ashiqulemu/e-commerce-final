<?php

namespace App\Http\Controllers;


use App\Category;
use App\Product;
use App\subcat;
use App\subsub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcat=DB::table('categories')
            ->join('subcats', 'categories.id', '=', 'subcats.category_id')
            ->select('subcats.*','categories.name as cname')
            ->orderBy('subcats.created_at', 'desc')
            ->get();

        return view('admin.pages.subcategory.manage',['subcat'=>$subcat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $category=Category::all();
        return view('admin.pages.subcategory.create',['category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',

        ]);
        $subcat=new subcat();
        $subcat->name=$request->name;
        $subcat->category_id=$request->category_id;
        $subcat->save();
        return redirect('/admin/subcategory/create')
            ->with(['type'=>'success','message'=>'Subcategory created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subcat  $subcat
     * @return \Illuminate\Http\Response
     */
    public function show(subcat $subcat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subcat  $subcat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $category=Category::all();
        $subcat=subcat::find($id);
        return view('admin.pages.subcategory.edit',['category'=>$category,  'subcat'=>$subcat,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subcat  $subcat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'category_id'=>'required',
        ]);
        $subcat=subcat::find($id);
        $subcat->name=$request->name;
        $subcat->category_id=(int)$request->category_id;
        $subcat->save();
        return redirect('/admin/subcategory')
            ->with(['type'=>'success','message'=>'Subcategory Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subcat  $subcat
     * @return \Illuminate\Http\Response
     */
    public function destroy(subcat $subcat, $id)
    {
        $productCategory = Product::wheresubcatId($subcat->id)->count();
        if($productCategory){
            return back()
                ->with([
                    'type'=>'error',
                    'message'=> "You have already ".$productCategory." product with this Category. Please delete product first."]);
        } else {

           $subcat=subcat::find($id);
           $subcat->delete();
           $subsub=DB::table('subsubs')
               ->select('id')
               ->wehere('subcat_id','=',$id)
               ->get();
           $sub=subsub::find((int)$subsub);
           $sub->delete();
            return back()
                ->with(['type'=>'success','message'=>'Subcategory deleted successfully']);
        }
    }
}
