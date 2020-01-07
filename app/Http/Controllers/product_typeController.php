<?php

namespace App\Http\Controllers;
use App\product_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class product_typeController extends Controller
{
    public function index()
    {

        $products_type = product_type::with('product')->get();
        return view('admin.product_type.index', compact('products_type'));
    }


    public function create()
    {
        return view('admin.product_type.create');
    }


    public function store(Request $request)
    {


        product_type::create($request ->all());

        return redirect('/admin/product_type');
    }




    public function edit($id)
    {


        $items = product_type::find($id);
        return view('admin.product_type.edit', compact('items'));
    }


    public function update(Request $request, $id)
    {

        $product_type = product_type::find($id);
        $product_type->update($request->all());
        return redirect('/admin/product_type');
    }


    public function destroy($id)
    {
       product_type::destroy($id);

        return redirect('/admin/product_type');
    }
}
