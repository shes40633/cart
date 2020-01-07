@extends('layouts.front')
@section('content')

<div class="content">

 <div>

<div class="container">
    @foreach ($products_types as $products_type)
    <a href="/product_type/{{$products_type->id}}">
        <h1>{{ $products_type->type_name}}</h1>
    </a>
    <div class="row">
        @foreach ($products_type->product as $product)
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
    @endforeach
</div>

  @endsection

@section('js')

@endsection
