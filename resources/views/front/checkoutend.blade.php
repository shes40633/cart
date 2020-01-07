@extends('layouts.front')

@section('css')
<style>
.col_label{
    width: 75px;
}

.btn_flex{
    display: flex;
    align-items: flex-end;
    flex-wrap: wrap;
    flex-direction: column;
    justify-content: flex-end;
}
.btn_sign{
    display: block;
width: 100%;
height: 40px;
}
.time_btn{
    padding: 3px 20px;
    border: 1px solid black;
}
.time_btn:nth-child(2){
    border-right-style:none;
    border-left-style:none;
}
.show{
    background-color: black;
    color:white;
}
.input_time{
    margin-left: 15px;
}
.btn_sign_margin{
    margin-top: 10px;
}
.error {
  color: red;
  margin-left: 5px;
}


label.error {
  display: inline;
}
</style>
@endsection


@section('content')

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



@endsection

@section('js')





@endsection
