@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">訂單管理</div>
                <div class="card-body">
                    <a class="btn btn-light" href="/admin/order">全部訂單</a>
                    <a class="btn btn-info" href="/admin/order/select/新訂單">未付款訂單</a>
                    <a class="btn btn-warning" href="/admin/order/select/已完成">已完成付款</a>
                    <a class="btn btn-success" href="/admin/order/select/已出貨">已出貨</a>
                    <hr>

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>訂單編號</th>
                                <th>訂購人姓名</th>
                                <th>訂購人電話</th>
                                <th>price</th>
                                <th>status</th>
                                <th style="width:200px">功能</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{$item->order_no}}</td>
                                <td>{{$item->recipient_name}}</td>
                                <td>{{$item->recipient_cellphone}}</td>
                                <td>{{$item->totalprice}}</td>
                                <td>
                                    @if ($item->status == "新訂單")
                                    <span class="badge badge-info">未付款訂單</span>

                                    @elseif($item->status == "已完成")
                                    <span class="badge badge-warning">已完成付款</span>
                                    @elseif($item->status == "已出貨")
                                    <span class="badge badge-success">已出貨</span>
                                    @endif


                                </td>
                                <td>
                                    <div class="card-body">
                                        <a class="btn btn-success" href="/admin/order/show/{{$item->order_no}}">訂單詳細</a>

                                        @if ($item->status == "已完成")
                                        <a class="btn btn-info" href="" data-shipid="{{$item->order_no}}">
                                            更改狀態
                                        </a>

                                        <form class="ship-form" data-shipid="{{$item->order_no}}" action="/admin/order/changestatus/{{$item->order_no}}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        @endif


                                        <a class="btn btn-danger" href="" data-itemid="{{$item->order_no}}">
                                            訂單刪除
                                        </a>

                                        <form class="destroy-form" data-itemid="{{$item->order_no}}" action="/admin/order/destroy/{{$item->order_no}}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection


    @section('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
     $(document).ready(function() {
            $('#example').DataTable({
                "order": [1,"desc"]
            });

            $('#example').on('click','.btn-danger',function(){
                event.preventDefault();
                var r = confirm("你確定要刪除此項目嗎?");
                if (r == true) {
                    var itemid = $(this).data("itemid");
                    $(`.destroy-form[data-itemid="${itemid}"]`)[0].submit();
                }
            });
            $('#example').on('click','.btn-info',function(){
                event.preventDefault();
                var r = confirm("是否更改為已出貨?");
                if (r == true) {
                    var shipd = $(this).data("shipid");
                    $(`.ship-form[data-shipid="${shipd}"]`)[0].submit();
                }
            });
        });
    </script>

    @endsection
