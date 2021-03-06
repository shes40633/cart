@extends('layouts.app')


@section('css')

@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">消息管理-edit</div>

                <form method="post" action="/admin/news/update/{{$items ->id}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title"  value="{{$items ->title}}"name="title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sort" class="col-sm-2 col-form-label">sort</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="sort"  value="{{$items ->sort}}" name="sort">
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

@endsection

