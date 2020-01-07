@extends('layouts.app')


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">消息管理</div>
                <div class="card-body">
                    <a class="btn btn-success" href="/admin/news/create">新增最新消息</a>
                    <hr>

                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>標題</th>
                                <th>排序</th>
                                <th>功能</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->sort}}</td>
                                <td>
                                    <div class="card-body">
                                        <a class="btn btn-success" href="/admin/news/edit/{{$item->id}}">編輯</a>
                                        <a class="btn btn-danger" href="" data-itemid="{{$item->id}}">
                                            刪除
                                        </a>

                                        <form class="destroy-form" data-itemid="{{$item->id}}" action="/admin/news/destroy/{{$item->id}}" method="POST"
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
        });
    </script>

    @endsection
