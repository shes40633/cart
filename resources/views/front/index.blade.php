@extends('layouts.front')


@section('css')

<style>
    html, body {
      position: relative;
      height: 100%;
    }
    body {
      background: #eee;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color:#000;
      margin: 0;
      padding: 0;
    }
    .swiper-container {
      width: 100%;
      height: 100%;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

  </style>

@endsection





@section('content')


<div class="swiper-container banner_swiper">
        <div class="swiper-wrapper">
                @foreach ($banners as $banner)
          <div class="swiper-slide">
                <img src="{{$banner -> imges}}"  alt="...">
            </div>
            @endforeach
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
      </div>



<div class="container">

        <div class="swiper-container product_siper">
                <div class="swiper-wrapper ">

                        @foreach ($products as $product)
                        <div class="swiper-slide">
                              <a href="/products/{{ $product ->id }}">
                              <img src="{{asset('/storage/'.$product->imges)}}" class="card-img-top" alt="...">

                              <div class="content">
                                      <h1>{{$product->title}}</h1>
                                      <p>{!!$product->description!!}</p>
                              </div>


                                  </a>


                        </div>
                        @endforeach


                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>

</div>








<div class="container">
        <ul class="list-group">
                @foreach ($news as $new)
                <li class="list-group-item">
                        <a href="/news/{{ $new ->id }}">
                            <h1>{{$new->title}}</h1>
                        </a>
                </li>
                @endforeach
              </ul>
              {{ $news->links() }}

</div>

@endsection



@section('js')

<script>
    var swiper = new Swiper('.banner_swiper', {
      cssMode: true,
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination'
      },
      mousewheel: true,
      keyboard: true,
    });

    var swiper2 = new Swiper('.product_siper', {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });


  </script>

@endsection
