@extends('layouts.app')


@section('css')

@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">消息管理-edit</div>

                <form method="post" action="/admin/product/update/{{$items ->id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title"  value="{{$items ->title}}"name="title"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type_id" class="col-sm-2 col-form-label">type_id</label>
                        <div class="col-sm-10">
                            <select name="type_id"class="form-control" id="type_id" >
                                @foreach ($products_type as $product_type)
                            <option value="{{$product_type->id}}" @if($product_type->type_id === $items->type_id) selected @endif required>{{$product_type->type_name}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sort" class="col-sm-2 col-form-label">sort</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="sort"  value="{{$items ->sort}}" name="sort"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">description</label>
                        <div class="col-sm-10">
                            <textarea id="description" name="description" class="form-control"required >{!!$items ->description!!}</textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="price"  value="{{$items ->price}}"name="price"required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="imges" class="col-sm-2 col-form-label">現有產品圖片</label>
                        <div class="col-sm-10">
                            <img class="img-fluid" src="{{asset('/storage/'.$items->imges)}}" alt="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="imges" class="col-sm-2 col-form-label">重新上傳產品圖片 <br><small
                                class="text-danger">*建議圖片尺寸500px(寬)*700px(高)</small></label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="imges" value="" name="imges">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="imgs" class="col-sm-2 col-form-label">現有產品組圖片</label>
                        @foreach ($items->productimg as $productimg)
                        <div class="col-sm-2 product_img" data-productimgid="{{$productimg->id}}">
                            <img class="img-fluid" src="{{asset('/storage/'.$productimg->imges)}}" alt="">
                        <button class="btn btn-danger btn-sm" data-productimgid="{{$productimg->id}}" type="button">X</button>
                            <div class="sort">
                                <label for="imgs">Sort</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group row">
                        <label for="imgs" class="col-sm-2 col-form-label">重新上傳產品組圖片 <br><small
                                class="text-danger">*建議圖片尺寸500px(寬)*700px(高)</small></label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="imgs" name="imgs[]" multiple>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script>
    $(document).ready(function() {
            $('#description').summernote({
                height: 150,
                lang: 'zh-TW',
                callbacks: {
                    onImageUpload: function(files) {
                        for(let i=0; i < files.length; i++) {
                            $.upload(files[i]);
                        }
                    },
                    onMediaDelete : function(target) {
                        $.delete(target[0].getAttribute("src"));
                    }
                },
            });


            $.upload = function (file) {
                let out = new FormData();
                out.append('file', file, file.name);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',
                    url: '/admin/ajax_upload_img',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: out,
                    success: function (img) {
                        $('#description').summernote('insertImage', img);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            };

            $.delete = function (file_link) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',
                    url: '/admin/ajax_delete_img',
                    data: {file_link:file_link},
                    success: function (img) {
                        console.log("delete:",img);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            }
            $('.product_img .btn-danger').click(function () {
                var productimgs = $(this).data('productimgid');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: 'POST',
                    url: '/admin/ajax_delete_productimg',
                    data: {productimgs: productimgs},
                    success: function (res) {
                        $( `.product_img[data-productimgid='${productimgs}']` ).remove();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });

            })
       });

    </script>
@endsection

