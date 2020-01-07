<?php

namespace App\Http\Controllers;

use App\Product;
use App\productimg;
use App\product_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {
        $items = Product::with('product_type')->get();
        return view('admin.product.index', compact('items'));
    }

    public function create()
    {
        $products_type = product_type::all();
        return view('admin.product.create', compact('products_type'));
    }

    public function store(Request $request)
    {
        $requsetData = $request->all();


        //上傳檔案
        $items = $request->file('img')->store('', 'public');
        // 檔案存到public裡
        $requsetData['imges'] = $items;

        $new_product = Product::create($requsetData);
        $new_product_id = $new_product->id;
        //多張上傳
        $files = $request->file('imgs');
        if ($request->hasFile('imgs')) {
            foreach ($files as $file) {
                // 上傳圖片
                $items = $file->store('', 'public');

                // 新增進DB
                $product_img = new productimg;
                $product_img->product_id = $new_product_id;
                $product_img->imges = $items;
                $product_img->save();
            }
        }


        return redirect('/admin/product');
    }


    public function edit($id)
    {
        $items = Product::where('id', $id)->with('productimg')->first();
        $products_type = product_type::all();
        return view('admin.product.edit', compact('items', 'products_type'));
    }


    public function update(Request $request, $id)
    {
        $item = Product::find($id);

        $requsetData = $request->all();
        if ($request->hasFile('imges')) {
            //上傳單一檔案
            $items = $request->file('imges')->store('', 'public');
            $requsetData['imges'] = $items;
            $old_image = '/storage/' . $items->imges;
            File::delete(public_path($old_image));
        }



        if ($request->hasFile('imgs')) {
            $files = $request->file('imgs');
            foreach ($files as $file) {
                $items = $file->store('', 'public');

                // 新增進DB
                $product_img = new productimg;
                $product_img->product_id = $id;
                $product_img->imges = $items;
                $product_img->save();
            }
        }
        $item->update($requsetData);

        return redirect('/admin/product');
    }


    public function destroy($id)
     {
        //  單一圖片刪除
        //  找到prodcut id
        $item = Product::find($id);
        // 只到圖片路徑
        $old_image = '/storage/' . $item->imges;
        // 確認圖片是否一樣
        if (file_exists(public_path($old_image))) {
            File::delete(public_path($old_image));
        }
        $item->delete();

        $productimgs = productimg::where('product_id', $id)->get();

        foreach ($productimgs as $productimg) {
            $old_image = '/storage/' . $productimg->imges;

            if (file_exists(public_path($old_image))) {
                File::delete(public_path($old_image));
            }

        }

        productimg::where('product_id', $id)->delete();

        return redirect('/admin/product');
    }
}
