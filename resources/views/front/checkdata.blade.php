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

        <form method="post" action="/checkout" id="form">

         @csrf
    <div class="row">
         <div class="col-10">



            <div class="form-group row">

              <label for="recipient_name" class=" col-form-label col_label">聯絡姓名*</label>
              <div class="col-sm">
                <input type="text" class="form-control" id="recipient_name" name=recipient_name required>
              </div>
            </div>

            <div class="form-group row">

                <label for="recipient_phone" class=" col-form-label col_label">連絡電話*</label>
                <div class="col-sm">
                  <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" required>
                </div>
              </div>

              <div class="form-group row">

                <label for="recipient_cellphone" class=" col-form-label col_label">手&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp機*</label>
                <div class="col-sm">
                  <input type="text" class="form-control" id="recipient_cellphone" name="recipient_cellphone" required>
                </div>
              </div>
              <div class="form-group row">

                <label for="recipient_adress" class=" col-form-label col_label">收件地址*</label>
                <div class="col-sm">
                  <input type="text" class="form-control" id="recipient_adress" name="recipient_adress">
                </div>
              </div>
              <div class="form-group row">

                <label for="recipient_email" class=" col-form-label col_label">電子郵件*</label>
                <div class="col-sm">
                  <input type="email" class="form-control" id="recipient_email" name="recipient_email" required>
                </div>
              </div>


            <fieldset class="form-group">
              <div class="row">
                <legend class="col-form-label  pt-0 col_label">發票方式</legend>
                <div class="col-sm d-flex">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="invoice" id="invoice1" value="option1" checked>
                    <label class="form-check-label" for="invoice1">
                      二聯式發票
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="invoice" id="invoice2" value="option2">
                    <label class="form-check-label" for="invoice2">
                      三聯式發票
                    </label>
                  </div>

                </div>
              </div>
            </fieldset>
            <div class="form-group row">
              <div class="col_label">送貨時間*</div>
              <div class="col-sm-10">
                <div class="form-check d-flex">
                    <div class="time_btn show">皆可</div>
                    <div class="time_btn">早上</div>
                    <div class="time_btn">下午</div>
                    <input type="text" class="input_time" id="input_time" value="皆可" name="input_time">
                </div>
              </div>
            </div>


            <div class="form-group row">
                <label for="recipient_remark" class=" col-form-label col_label">備&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp註</label>
                <div class="col-sm">
                    <textarea id="recipient_remark" cols="30" rows="10"class="form-control" name="recipient_remark">
                    </textarea>
                </div>
              </div>



        </div>




              <div class="col-12 col-sm-2 btn_flex">
                <a href="/cart" class="btn btn-primary btn_sign">回上一頁</a>


                <button type="submit" class="btn btn-primary btn_sign btn_sign_margin" >Sign in</button>
              </div>


            </div>
          </form>


    </div>
</template>



@endsection

@section('js')



<script>
$(".time_btn").click(function(){
  $(".time_btn").removeClass('show');
  $(this).addClass('show');
  console.log(this.textContent);

  var content = this.textContent;
  $('#input_time').val(content);
});




</script>

@endsection
