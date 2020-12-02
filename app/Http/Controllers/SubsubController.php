<?php

namespace App\Http\Controllers;


use App\subcat;
use App\subsub;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubsubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcat=DB::table('subcats')
            ->join('subsubs', 'subcats.id', '=', 'subsubs.subcat_id')
            ->select('subsubs.*','subcats.name as cname')
            ->orderBy('subsubs.created_at', 'desc')
            ->get();

        return view('admin.pages.subsubcategory.manage',['subcat'=>$subcat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcat=subcat::all();
        return view('admin.pages.subsubcategory.create',['category'=>$subcat]);
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
            'subcat_id'=>'required',

        ]);
        $subsub=new subsub();
        $subsub->name=$request->name;
        $subsub->subcat_id=(int)$request->subcat_id;
        $subsub->save();
        return redirect('/admin/subsub/create')
            ->with(['type'=>'success','message'=>'Sub-subcategory created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subsub  $subsub
     * @return \Illuminate\Http\Response
     */
    public function show(subsub $subsub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\subsub  $subsub
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=subcat::all();
        $subcat=subsub::find($id);
        return view('admin.pages.subsubcategory.edit',['category'=>$category,  'subcat'=>$subcat,'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\subsub  $subsub
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'subcat_id'=>'required',
        ]);
        $subcat=subsub::find($id);
        $subcat->name=$request->name;
        $subcat->subcat_id=(int)$request->subcat_id;
        $subcat->save();
        return redirect('/admin/subsub')
            ->with(['type'=>'success','message'=>'Sub-sub category Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subsub  $subsub
     * @return \Illuminate\Http\Response
     */
    public function destroy(subsub $subcat, $id)
    {
        $productCategory = Product::wheresubId($subcat->id)->count();
        if($productCategory){
            return back()
                ->with([
                    'type'=>'error',
                    'message'=> "You have already ".$productCategory." product with this subsubCategory. Please delete product first."]);
        } else {

            $subcat=subsub::find($id);
            $subcat->delete();
            return back()
                ->with(['type'=>'success','message'=>'Sub-sub-category deleted successfully']);
        }
    }
}
