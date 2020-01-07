@extends('layouts.front')
@section('content')


<div class="swiper-container">
    <div class="swiper-wrapper">
        @foreach ($products->productimg as $product)
        <div class="swiper-slide">
            <img src="{{asset('/storage/'.$product->imges)}}" alt="">
        </div>

        @endforeach

    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>

<button class="btn btn-danger addcart" data-productid="{{$products->id}}">加入購物車</button>

@endsection


@section('js')
<script>
    var swiper = new Swiper('.swiper-container', {
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });


        $('.addcart').click(function () {
            var product_id = $(this).data('productid');
            console.log(product_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'POST',
                url: '/addcart',
                data: {product_id:product_id},
                success: function (res) {
                    $('#cartTotalQuantity').text(res);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        });

        

</script>
@endsection
