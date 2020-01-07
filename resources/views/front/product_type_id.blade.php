@extends('layouts.front')
@section('content')

<div class="container">

    <h1>{{$product_type_ids->type_name}}</h1>

    <div class="row">
    @foreach ($product_type_ids->product as $product)
    <a href="/products/{{ $product->id }}">
        <div class="col-md-4">
                <img src="{{asset('/storage/'.$product->imges)}}" alt="">
                <div class="card-body">
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-text">{!!$product->description!!}</p>
                </div>
            </div>
    </a>

@endforeach

    </div>
</div>

@endsection

@section('js')

@endsection
