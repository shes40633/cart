@extends('layouts.app')


@section('css')

@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">訂單詳細</div>
             <template>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">name</th>
                                        <th scope="col">price</th>
                                        <th scope="col">qty</th>
                                        <th scope="col">sub_price</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <div>訂單編號:{{$new_order->order_no}}</div>
                                    @foreach ($getContent as $item)
                                    <tr>
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->price * $item->quantity}}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="total">總計:{{$total}}</div>

                        </div>
                    </div>

            <br>


                     @csrf
                <div class="row">
                     <div class="col-10">




                        <div class="form-group row">
                          <label for="recipient_name" class=" col-form-label col_label">聯絡姓名</label>
                          <div class="col-sm">
                            <div   id="recipient_name" name=recipient_name >{{$new_order->recipient_name}}</div>
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class=" col-form-label col_label">訂單狀態</label>
                            <div class="col-sm">
                              <div   id="status" name=status >{{$new_order->status}}</div>
                            </div>
                          </div>
                        <div class="form-group row">

                            <label for="recipient_phone" class=" col-form-label col_label">連絡電話</label>
                            <div class="col-sm">
                              <div   id="recipient_phone" name="recipient_phone" >{{$new_order->recipient_phone}}</div>
                            </div>
                          </div>

                          <div class="form-group row">

                            <label for="recipient_cellphone" class=" col-form-label col_label">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp機</label>
                            <div class="col-sm">
                              <div   id="recipient_cellphone" name="recipient_cellphone" >{{$new_order->recipient_cellphone}}</div>
                            </div>
                          </div>
                          <div class="form-group row">

                            <label for="recipient_adress" class=" col-form-label col_label">收件地址</label>
                            <div class="col-sm">
                              <div  id="recipient_adress" name="recipient_adress"> {{$new_order->recipient_adress}}</div>
                            </div>
                          </div>
                          <div class="form-group row">

                            <label for="recipient_email" class=" col-form-label col_label">電子郵件</label>
                            <div class="col-sm">
                              <div type="email"  id="recipient_email" name="recipient_email" >{{$new_order->recipient_email}}</div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="recipient_remark" class=" col-form-label col_label">備&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp註</label>
                            <div class="col-sm">
                                <div id="recipient_remark" cols="30" rows="10" name="recipient_remark">
                                </div>
                            </div>
                          </div>


                    </div>




                          <div class="col-12 col-sm-2 btn_flex">
                            <a href="/products" class="btn btn-primary btn_sign">回首頁</a>
                          </div>


                        </div>



                </div>
            </template>




            </div>
        </div>
    </div>
</div>

@endsection


@section('js')

@endsection
