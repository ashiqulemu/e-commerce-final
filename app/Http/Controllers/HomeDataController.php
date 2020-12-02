<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeDataController extends Controller
{
    public function index(){
        if(auth()->user()){
            return redirect('/user-home');
        }
        if(request()->input('ref')) {
            Session::put('ref', request()->input('ref'));
        }


        $latest=DB::table('products')
                ->select('*')
                ->where('status','=',1 )
                ->where('quantity','>',1)
                ->latest()->take(8)->get();

        $favorite=DB::table('products')
            ->select('*')
            ->where('status','=',1 )
            ->where('quantity','>',1)
            ->where('popular','=',1)->take(8)->get();
        $category=DB::table('categories')
            ->select('*')
            ->where('status','=',1)
            ->latest()
            ->take(6)
            ->get();


        return view('site.pages.home',[

            'latest'=>$latest,
            'category'=>$category,
            'popular'=> $favorite,
        ]);
    }
}
