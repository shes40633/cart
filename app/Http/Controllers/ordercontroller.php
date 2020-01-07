<?php

namespace App\Http\Controllers;

use App\orders;
use App\orderitems;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class ordercontroller extends Controller
{
    public function index(){
        $items = orders::all();
        return view('admin.order.index',compact('items'));
    }



    public function show($order_no){
       $new_order = orders::where('order_no',$order_no)->with('orderitems')->first();
       $userId = auth()->user()->id;
       $total = \Cart::session($userId)->getTotal();
       $getContent = \Cart::session($userId)->getContent()->sort();
       return view('admin.order.show',compact('new_order','total','getContent'));


    }




    public function changestatus(Request $request, $order_no){


        $changestatus = orders::where('order_no',$order_no)->first();
        $changestatus->status="已出貨";
        $changestatus->save();
        return redirect()->back();
    }


    public function select($status){

        $items = orders::where('status',$status)->get();

        return view('admin.order.index',compact('items'));
        }


    public function destroy(Request $request,$order_no){

        $items = orders::where('order_no',$order_no)->first();
        // dd($items->id);
        $orderitems = orderitems::where('id',$items->id)->get();

        foreach ($orderitems as $orderitem) {
            $orderitem->delete();
        }
        $items->delete();

        return redirect()->back();

        }

}
