@extends('layouts.front')
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
                            <th scope="col">delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($getContent as $item)
                        <tr>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}}</td>
                            <td><input type="text" class="changeqty" value="{{$item->quantity}}"
                                    data-itemid="{{$item->id}}"></td>
                            <td>{{$item->price * $item->quantity}}</td>
                            <td><button class="btn btn-danger deleteproduct_cart"
                                    data-itemid="{{$item->id}}">Delete</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="total">總計:{{$total}}</div>
                <a href="/checkdata" class="btn btn-success">確認結帳</a>
            </div>
        </div>
    </div>
</template>



@endsection

@section('js')
<script>
    $( ".changeqty" ).change(function() {

        // 抓到變數qty
        var new_qty = this.value;
        var product_id = this.getAttribute('data-itemid');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: '/changeQty',
            data: {
                product_id:product_id,
                new_qty:new_qty
            },
            success: function (res) {
                document.location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus + " " + errorThrown);
            }
        });
    });

    $( ".deleteproduct_cart" ).on('click',function() {
var product_id = this.getAttribute('data-itemid');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    method: 'POST',
    url: '/deleteproduct_cart',
    data: {product_id:product_id},
    success: function (res) {
        document.location.reload();
    },
    error: function (jqXHR, textStatus, errorThrown) {
        console.error(textStatus + " " + errorThrown);
    }
});
});

</script>

@endsection

{{-- vue寫法 --}}
{{--
        <cart-component props-cartcontent="{{$getContent}}"></cart-component> --}}
