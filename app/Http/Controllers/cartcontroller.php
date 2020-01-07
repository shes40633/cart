<?php

namespace App\Http\Controllers;

use App\orders;
use App\Product;
use Carbon\Carbon;
use App\orderitems;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use TsaiYiHua\ECPay\Services\StringService;

class cartcontroller extends Controller
{

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }


    public function addcart(Request $request)
    {
        // productimg的product_id
        $product_id = $request->product_id;


        $product = Product::find($product_id);
        $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId)->add($product_id, $product->title, $product->price, 1, array());

        $cartTotalQuantity = \Cart::session($userId)->getTotalQuantity();
            return $cartTotalQuantity;

    }


    public function getcontent()
    {
        $userId = auth()->user()->id; // or any string represents user identifier
        $getContent = \Cart::session($userId)->getContent();

    }


    public function totalcart()
    {
        $userId = auth()->user()->id;
        $total = \Cart::session($userId)->getTotal();
        dd($total);
    }

    public function cart()
    {
        $userId = auth()->user()->id; // or any string represents user identifier
        // 用vue  $getContent 產品轉為jason格式  ->toJson()
        $getContent = \Cart::session($userId)->getContent();;
        $total = \Cart::session($userId)->getTotal();

        return view('front.cart',compact('getContent','total'));
    }

    public function changeQty(Request $request)
    {
        $product_id = $request->product_id;
        $new_qty= $request->new_qty;

        $userId = auth()->user()->id;
        \Cart::session($userId)->update($product_id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $new_qty
            ),
          ));

        return "success";
    }

    public function deleteproduct_cart(Request $request)
    {
        $product_id = $request->product_id;

        $userId = auth()->user()->id; // or any string represents user identifier
        \Cart::session($userId)->remove($product_id);

        return "success";
    }
    public function checkdata()
    {
        $userId = auth()->user()->id; // or any string represents user identifier
        $getContent = \Cart::session($userId)->getContent();
        $total = \Cart::session($userId)->getTotal();

        return view('front.checkdata',compact('getContent','total'));
    }
    public function checkout(Request $request)
    {
        $userId = auth()->user()->id; // or any string represents user identifier

        $total = \Cart::session($userId)->getTotal();

    // $new_order填寫的個資  $getContent產品資料

        $new_request=$request->all();
        $new_request["order_no"]='20191226-1';
        // 多做把總金額丟入$new_order
        $new_request["totalprice"]=\Cart::session($userId)->getTotal();

        $new_order = orders::create($new_request);

        $new_order->order_no=Carbon::now()->format('Ymd').$new_order->id;
        $new_order->save();


        $getContent = \Cart::session($userId)->getContent()->sort();

        $ary = [];

        foreach ($getContent as $item) {
            $order_item = new orderitems();
            $order_item->product_id = $item->id;
            $order_item->order_id = $new_order->id;
            $order_item->qty = $item->quantity;
            $order_item->price = $item->price;
            $order_item->save();

            $product = Product::find($item->id);
            $product_name = $product->title;

            $new_ary = [
                'name' => $product_name,
                'qty' => $item->quantity,
                'unit' => '個',
                'price' => $item->price
            ];
            array_push($ary, $new_ary);

        }


        // 第三方金流
        $formData = [
            'UserId' => 1, // 用戶ID , Optional
            'ItemDescription' => '產品簡介',
            // 'ItemName' => 'Product Name',
            'Items' => $ary,
            'OrderId' => Carbon::now()->format('Ymd').$new_order->id,
            // 'TotalAmount' => \Cart::session($userId)->getTotal(),
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
        ];
        \Cart::session($userId)->clear();
        return $this->checkout->setNotifyUrl(route('notify'))->setReturnUrl(route('return'))->setPostData($formData)->send();







    //     // from資料new_order  產品資料getContent


    }

    public function notifyUrl(Request $request)
    {
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if ($checkMacValue == $checkCode) {
            return '1|OK';
        } else {
            return '0|FAIL';
        }
    }
    public function returnUrl(Request $request)
    {
        $serverPost = $request->post();
        $checkMacValue = $request->post('CheckMacValue');
        unset($serverPost['CheckMacValue']);
        $checkCode = StringService::checkMacValueGenerator($serverPost);
        if ($checkMacValue == $checkCode) {
            if (!empty($request->input('redirect'))) {
                return redirect($request->input('redirect'));
            } else {
                //付款完成，下面接下來要將購物車訂單狀態改為已付款
                //目前是顯示所有資料將其DD出來
                // dd($serverPost);

                $order_no = $serverPost["MerchantTradeNo"];
                $order = orders::where('order_no',$order_no)->first();
                $order->status = "已完成";
                $order->save();
                return redirect("/checkoutend/{$order_no}");
            }
        }
    }
    public function checkoutend($order_no){
     $new_order = orders::where('order_no',$order_no)->with('orderitems')->first();
     $userId = auth()->user()->id;
     $total = \Cart::session($userId)->getTotal();
     $getContent = \Cart::session($userId)->getContent()->sort();
      return view('front.checkoutend',compact( 'new_order','total','getContent'));
    }
}
