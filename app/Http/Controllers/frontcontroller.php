<?php

namespace App\Http\Controllers;
use App\product_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;

class frontcontroller extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        $news = DB::table('news')->get();
        $banners = DB::table('banners')->get();
        $news = DB::table('news')->paginate(2);

        return view('front.index',compact('products' ,'news','banners'));
    }
    public function news()
    {
        $news = DB::table('news')->get();
        $news = DB::table('news')->paginate(2);
        return view('front.news', compact('news'));
    }

    public function products()
    {
        $products_types = product_type::with('product')->get();

        return view('front.products', compact('products_types'));
    }

    public function products_id($id)
    {
        $products = Product::with('productimg')->where('id',$id)->first();
        return view('front.products_id', compact('products'));
    }

    public function news_id($id)
    {
        $news_id = DB::table('news')->find($id);

        return view('front.news_id', compact('news_id'));
    }

    public function product_type()
    {
        $products_types = product_type::with('product')->get();
        return view('front.product_type', compact('products_types'));
    }
    public function product_type_id($id)
    {
        $product_type_ids = product_type::where('id',$id)->with('product')->first();
        return view('front.product_type_id', compact('product_type_ids'));
    }

}
